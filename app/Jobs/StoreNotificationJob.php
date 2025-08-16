<?php

namespace App\Jobs;

use App\Models\Notification;
use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\DB;

class StoreNotificationJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable;

    public $data;
    public $permission;
    public $sender_id;
    /**
     * Number of times the job may be attempted.
     */
    public $tries = 3;

    /**
     * The number of seconds the job can run before timing out.
     */
    public $timeout = 10;
    /**
     * Create a new job instance.
     */
    public function __construct($data, $permission, $sender_id)
    {
        $this->data = $data;
        $this->permission = $permission;
        $this->sender_id = $sender_id;
    }
    public function backoff(): int
    {
        return 5; // Retry after 5 seconds
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        try {
            $users = DB::table('users as u')
                ->join('role_permissions as rp', function ($join) {
                    $join->on('u.role_id', '=', 'rp.role')
                        ->where('rp.permission', $this->permission);
                })
                ->select('u.id')
                ->get();

            $now = $this->data['created_at'] ?? now();

            $notifications = [];

            foreach ($users as $user) {
                $notifications[] = [
                    'user_id' => $user->id,
                    'sender_id' => $this->sender_id,
                    'notifier_type_id' => $this->data['notifier_id'],
                    'message' => $this->data['message'],
                    'action_url' => $this->data['action_url'],
                    'context' => $this->data['context'], // Assuming DB column is JSON type
                    'created_at' => $now,
                    'updated_at' => $now, // Add if using Laravel timestamps
                ];
            }

            if (!empty($notifications)) {
                Notification::insert($notifications);
            }
        } catch (Exception $err) {
            // Exception caught and the variable $err is used here
            $logData = [
                'error_code' => $err->getCode(),
                'trace' => $err->getTraceAsString(),
                'exception_type' => get_class($err),
                'error_message' => $err->getMessage(),
                'user_id' => request()->user() ? request()->user()->id : "N/K", // If you have an authenticated user, you can add the user ID
                'username' => request()->user() ? request()->user()->username : "N/K", // If you have an authenticated user, you can add the user ID
                'ip_address' => request()->ip(),
                'method' => request()->method(),
                'uri' => request()->fullUrl(),
            ];
            LogErrorJob::dispatch($logData);
            Log::info('Global Exception =>' . json_encode($logData));
        }
    }
}
