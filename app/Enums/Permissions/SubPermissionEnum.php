<?php

namespace App\Enums\Permissions;

enum SubPermissionEnum: int
{
    // User
    case user_information = 1;
    case user_password = 2;
    case user_permission = 3;
    public const USERS = [
        1 => ['label' => "account_information", 'is_category' => false],
        2 => ['label' => "account_password", 'is_category' => false],
        3 => ['label' => "account_permissions", 'is_category' => false],
    ];

        // Configurations
    case configurations_job = 31;
    case configurations_checklist = 32;
    public const CONFIGURATIONS = [
        31 => ['label' => "job", 'is_category' => true],
        32 => ['label' => "checklist", 'is_category' => true],
    ];

        // Approval
    case user_approval = 51;
    public const APPROVALS = [
        51 => ['label' => "user", 'is_category' => false],
    ];

        // Activity
    case activity_user_activity = 71;
    case activity_password_activity = 72;
    public const ACTIVITY = [
        71 => ['label' => "user_activity", 'is_category' => false],
        72 => ['label' => "password_activity", 'is_category' => false],
    ];

        // About
    case about_director = 91;
    case about_manager = 92;
    case about_office = 93;
    case about_technical = 94;
    public const ABOUT = [
        91 => ['label' => "director", 'is_category' => true],
        92 => ['label' => "manager", 'is_category' => true],
        93 => ['label' => "office", 'is_category' => true],
        94 => ['label' => "technical_sup", 'is_category' => true],
    ];
}
