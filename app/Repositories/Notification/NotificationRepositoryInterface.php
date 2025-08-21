<?php

namespace App\Repositories\Notification;

interface NotificationRepositoryInterface
{
    /**
     * Retrieve NGO data when registeration is completed.
     * 
     *
     * @param string $notifier_id
     * @param array $message
     * @param string $action_url
     * @param string $context
     * @param string $permission
     */
    public function sendNotification($notifier_id, $message, $action_url, $context, $permission, $permissionName);
}
