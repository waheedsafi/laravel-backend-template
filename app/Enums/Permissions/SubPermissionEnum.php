<?php

namespace App\Enums\Permissions;

enum SubPermissionEnum: int
{
    // User
    case user_information = 1;
    case user_password = 2;
    case user_permission = 3;
    public const USERS = [
        1 => "account_information",
        2 => "update_account_password",
        3 => "permissions"
    ];
        // configurations
    case configurations_job = 21;
    public const CONFIGURATIONS = [
        21 => "job",
    ];
        // Approval
    case user_approval = 31;
    public const APPROVALS = [
        31 => "user",
    ];
        // Activity
    case user_activity = 51;
    case password_activity = 52;
    public const ACTIVITY = [
        51 => "user",
        52 => "password",
    ];

        // ABOUT
    case about_director = 71;
    case about_manager = 72;
    case about_office = 73;
    case about_slider_pic = 74;
    case about_technical = 75;
    public const ABOUT = [
        71 => "director",
        72 => "manager",
        73 => "office",
        74 => "pic",
        75 => "technical_sup"
    ];
}
