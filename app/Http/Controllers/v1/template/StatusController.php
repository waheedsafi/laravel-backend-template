<?php

namespace App\Http\Controllers\v1\template;

use Illuminate\Http\Request;
use App\Enums\Statuses\StatusEnum;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\App;
use App\Http\Controllers\Controller;
use App\Models\UserStatus;

class StatusController extends Controller
{
    // Users
    public function userIndex($id)
    {
        $locale = App::getLocale();

        $userStatus = DB::table('user_statuses as us')
            ->where("us.user_id", $id)
            ->where('is_active', true)
            ->select('us.status_id')
            ->first();
        if ($userStatus->status_id == StatusEnum::pending->value) {
            return response()->json(
                [
                    'message' => __('app_translation.user_need_approval')
                ],
                422,
                [],
                JSON_UNESCAPED_UNICODE
            );
        } else if ($userStatus->status_id == StatusEnum::block->value) {
            // Start building the query
            $tr = DB::table('status_trans as st')
                ->where('st.status_id', StatusEnum::active->value)
                ->where('st.language_name', $locale)
                ->select(
                    "st.status_id as id",
                    "st.name",
                )
                ->get();
        } else {
            $tr = DB::table('status_trans as st')
                ->where('st.status_id', StatusEnum::block->value)
                ->where('st.language_name', $locale)
                ->select(
                    "st.status_id as id",
                    "st.name",
                )
                ->get();
        }


        return response()->json(
            $tr,
            200,
            [],
            JSON_UNESCAPED_UNICODE
        );
    }
    public function userStatuses($id)
    {
        $locale = App::getLocale();

        // Start building the query
        $tr = DB::table('users as u')
            ->where('u.id', $id)
            ->join('user_statuses as us', 'u.id', '=', 'us.user_id')
            ->join('status_trans as st', function ($join) use ($locale) {
                $join->on('us.status_id', '=', 'st.status_id')
                    ->where('st.language_name', $locale);
            })
            ->leftJoin('users as user', 'user.id', '=', 'us.saved_by')
            ->select(
                "us.id",
                "st.name",
                "st.status_id",
                "us.is_active",
                "us.comment",
                "user.username as saved_by",
                "us.created_at",
            )
            ->get();

        return response()->json(
            $tr,
            200,
            [],
            JSON_UNESCAPED_UNICODE
        );
    }
    public function storeUser(Request $request)
    {
        // Validate request
        $validatedData = $request->validate([
            'id' => 'required|integer',
            'status_id' => 'required|integer',
            'comment' => 'required|string',
            'status' => 'required'
        ]);
        $userStatus = DB::table('user_statuses as us')
            ->where("us.user_id", $validatedData['id'])
            ->where('is_active', true)
            ->select('us.status_id')
            ->first();
        if ($userStatus->status_id == StatusEnum::pending->value) {
            return response()->json(
                [
                    'message' => __('app_translation.user_need_approval')
                ],
                422,
                [],
                JSON_UNESCAPED_UNICODE
            );
        }
        $authUser = $request->user();
        // Begin transaction
        DB::beginTransaction();
        // Fetch the currently active status for this NGO
        DB::table('user_statuses')
            ->where('user_id', (int) $validatedData['id'])
            ->where('is_active', true)
            ->limit(1)
            ->update(['is_active' => false]);

        $newStatus = UserStatus::create([
            "user_id" => (int) $validatedData['id'],
            "saved_by" => $authUser->id,
            "is_active" => true,
            "comment" => $validatedData['comment'],
            "status_id" => $validatedData['status_id'],
        ]);

        // Prepare response
        $data = [
            'id' => $newStatus->id,
            'is_active' => true,
            'name' => $validatedData['status'],
            'status_id' => $validatedData['status_id'],
            "comment" => $validatedData['comment'],
            'username' => $authUser->username,
            'created_at' => $newStatus->created_at,
        ];
        DB::commit();

        return response()->json([
            'message' => __('app_translation.success'),
            'status' => $data
        ], 200, [], JSON_UNESCAPED_UNICODE);
    }
}
