<?php

namespace App\Http\Controllers\v1\template;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Approval;
use App\Models\UserStatus;
use App\Traits\FilterTrait;
use Illuminate\Http\Request;
use App\Enums\Types\NotifierEnum;
use App\Enums\Statuses\StatusEnum;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Enums\Types\ApprovalTypeEnum;
use App\Enums\Permissions\PermissionEnum;
use App\Repositories\Approval\ApprovalRepositoryInterface;
use App\Repositories\Notification\NotificationRepositoryInterface;

class ApprovalController extends Controller
{
    // use HelperTrait;
    use FilterTrait;
    protected $approvalRepository;
    protected $notificationRepository;

    public function __construct(
        ApprovalRepositoryInterface $approvalRepository,
        NotificationRepositoryInterface $notificationRepository,
    ) {
        $this->approvalRepository = $approvalRepository;
        $this->notificationRepository = $notificationRepository;
    }
    public function approval($approval_id)
    {
        $approval =  DB::table('approvals as a')
            ->where('a.id', $approval_id)->first();
        if (!$approval) {
            return response()->json([
                'message' => __('app_translation.approval_not_found'),
            ], 404, [], JSON_UNESCAPED_UNICODE);
        }
        $tr = [];
        if ($approval->requester_type == User::class) {
            $tr = $this->approvalRepository->userApproval($approval_id);
        }
        return response()->json($tr, 200, [], JSON_UNESCAPED_UNICODE);
    }
    public function store(Request $request)
    {
        $request->validate([
            "approved" => "required",
            "approval_id" => "required",
        ]);
        $approval_id = $request->approval_id;
        $approval =  Approval::find($approval_id);
        if (!$approval) {
            return response()->json([
                'message' => __('app_translation.approval_not_found'),
            ], 404, [], JSON_UNESCAPED_UNICODE);
        }
        $message = '';
        DB::beginTransaction();
        $authUser = $request->user();
        if ($approval->requester_type === User::class) {
            if ($approval->notifier_type_id == NotifierEnum::confirm_adding_user->value) {
                DB::table('user_statuses')
                    ->where('user_id', $approval->requester_id)
                    ->where('is_active', true)
                    ->limit(1)
                    ->update(['is_active' => false]);
                $user = DB::table('users as u')
                    ->where('u.id', $approval->requester_id)
                    ->first();
                if ($request->approved) {
                    UserStatus::create([
                        "user_id" => $approval->requester_id,
                        "saved_by" => $request->user()->id,
                        "is_active" => true,
                        "status_id" => StatusEnum::active->value,
                    ]);
                    $approval->approval_type_id = ApprovalTypeEnum::approved->value;
                    $message = __('app_translation.user_approved', ['username' => $user->username ?? 'Unknown User']);
                } else {
                    UserStatus::create([
                        "user_id" => $approval->requester_id,
                        "saved_by" => $request->user()->id,
                        "is_active" => true,
                        "status_id" => StatusEnum::rejected->value,
                    ]);
                    $approval->approval_type_id = ApprovalTypeEnum::rejected->value;
                    $message = __('app_translation.user_rejected', ['username' => $user->username ?? 'Unknown User']);
                }
            }
        }
        $approval->respond_comment = $request->respond_comment;
        $approval->respond_date = Carbon::now();
        $approval->responder_id = $authUser->id;
        $approval->completed = true;
        $approval->save();

        DB::commit();

        // Notification
        $this->notificationRepository->sendNotification(
            NotifierEnum::confirm_adding_user->value,
            $message,
            null,
            null,
            now(),
            PermissionEnum::users->value,
            'users'
        );
        return response()->json([
            'message' => __('app_translation.success'),
        ], 200, [], JSON_UNESCAPED_UNICODE);
    }
    // User
    public function pendingUserApproval(Request $request)
    {
        $perPage = $request->input('per_page', 10); // Number of records per page
        $page = $request->input('page', 1); // Current page

        $query = $this->approvalRepository->getByNotifierTypeAndRequesterType(
            ApprovalTypeEnum::pending->value,
            User::class
        );
        $this->applySearch($query, $request, [
            'id' => 'a.id',
            'requester' => 'usr.username',
        ]);
        $approvals = $query->paginate($perPage, ['*'], 'page', $page);

        return response()->json($approvals, 200, [], JSON_UNESCAPED_UNICODE);
    }
    public function approvedUserApproval(Request $request)
    {
        $perPage = $request->input('per_page', 10); // Number of records per page
        $page = $request->input('page', 1); // Current page

        $query = $this->approvalRepository->getByNotifierTypeAndRequesterType(
            ApprovalTypeEnum::approved->value,
            User::class
        );
        $this->applySearch($query, $request, [
            'id' => 'a.id',
            'requester' => 'usr.username',
        ]);
        $approvals = $query->paginate($perPage, ['*'], 'page', $page);

        return response()->json($approvals, 200, [], JSON_UNESCAPED_UNICODE);
    }
    public function rejectedUserApproval(Request $request)
    {
        $perPage = $request->input('per_page', 10); // Number of records per page
        $page = $request->input('page', 1); // Current page

        $query = $this->approvalRepository->getByNotifierTypeAndRequesterType(
            ApprovalTypeEnum::rejected->value,
            User::class
        );
        $this->applySearch($query, $request, [
            'id' => 'a.id',
            'requester' => 'usr.username',
        ]);
        $approvals = $query->paginate($perPage, ['*'], 'page', $page);

        return response()->json($approvals, 200, [], JSON_UNESCAPED_UNICODE);
    }
    public function requestForUser(Request $request, $id)
    {
        $user = User::find($id);
        if (!$user) {
            return response()->json([
                'message' => __('app_translation.user_not_found'),
            ], 404, [], JSON_UNESCAPED_UNICODE);
        }
        $userStatus = DB::table('user_statuses as us')
            ->where("us.user_id", $user->id)
            ->where('is_active', true)
            ->select('us.status_id')
            ->first();
        DB::beginTransaction();

        if (
            $userStatus->status_id != StatusEnum::rejected->value
        ) {
            return response()->json([
                'message' => __('app_translation.your_account_un_app'),
            ], 403, [], JSON_UNESCAPED_UNICODE);
        }
        DB::table('user_statuses')
            ->where('user_id', $user->id)
            ->where('is_active', true)
            ->limit(1)
            ->update(['is_active' => false]);

        UserStatus::create([
            "user_id" => $user->id,
            "saved_by" => $request->user()->id,
            "is_active" => true,
            "status_id" => StatusEnum::pending->value,
        ]);
        $this->approvalRepository->storeApproval(
            $id,
            User::class,
            NotifierEnum::confirm_adding_user->value,
            ''
        );
        DB::commit();
        return response()->json([
            'message' => __('app_translation.success'),
            'status_id' => StatusEnum::pending->value,
        ], 200, [], JSON_UNESCAPED_UNICODE);
    }
}
