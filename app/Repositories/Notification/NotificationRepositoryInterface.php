<?php

namespace App\Repositories\Notification;

interface NotificationRepositoryInterface
{
    /**
     * Retrieve NGO data when registeration is completed.
     * 
     *
     * @param string $notifier_id
     * @param string $message
     * @param string $action_url
     * @param string $context
     * @param string $created_at
     * @param string $permission
     */
    public function sendNotification($notifier_id, $message, $action_url, $context, $created_at, $permission, $permissionName);
}
