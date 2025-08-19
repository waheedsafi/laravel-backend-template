<?php

namespace App\Repositories\Notification;

use App\Jobs\SendNotificationJob;
use App\Jobs\StoreNotificationJob;

class NotificationRepository implements NotificationRepositoryInterface
{
    public function sendNotification($notifier_id, $message, $action_url, $context, $permission, $permissionName)
    {
        $data = [
            'notifier_id' => $notifier_id,
            'message' => $message,
            'action_url' => $action_url,
            'context' => $context,
            'created_at' => now(),
            'permissionName' => $permissionName,
        ];
        $requestDetail = [
            'user_id' => request()->user() ? request()->user()->id : "N/K",
            'username' => request()->user() ? request()->user()->username : "N/K",
            'ip_address' => request()->ip(),
            'method' => request()->method(),
            'uri' => request()->fullUrl(),
        ];
        // 1. Store notification for authorized users
        StoreNotificationJob::dispatch(
            $data,
            $permission,
            $requestDetail
        );
        // 2. Send to express to give them notification


        SendNotificationJob::dispatch(
            'http://localhost:8001/api/v1/notification',
            $data,
            $requestDetail
        );
    }
}
