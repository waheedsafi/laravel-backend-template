<?php

namespace App\Repositories\Notification;

use App\Jobs\SendNotificationJob;
use App\Jobs\StoreNotificationJob;

class NotificationRepository implements NotificationRepositoryInterface
{
    public function sendNotification($notifier_id, $message, $action_url, $context, $created_at, $permission, $permissionName)
    {
        $data =  [
            'notifier_id' => $notifier_id,
            'message' => $message,
            'created_at' => $created_at,
            'action_url' => $action_url,
            'context' => $context,
            'permissionName' => $permissionName,
            'created_at' => $created_at,
        ];
        // 1. Store notification for authorized users
        StoreNotificationJob::dispatch(
            $data,
            $permission,
            request()->user()->id
        );
        // 2. Send to express to give them notification
        $requestDetail = [
            'user_id' => request()->user() ? request()->user()->id : "N/K",
            'username' => request()->user() ? request()->user()->username : "N/K",
            'ip_address' => request()->ip(),
            'method' => request()->method(),
            'uri' => request()->fullUrl(),
        ];
        SendNotificationJob::dispatch(
            'http://localhost:8001/api/v1/notification',
            $data,
            $requestDetail
        );
    }
}
