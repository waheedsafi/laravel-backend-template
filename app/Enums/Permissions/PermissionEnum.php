<?php

namespace App\Enums\Permissions;

enum PermissionEnum: int
{
    case logs = 1; //logs
    case reports = 2; //reports
    case configurations = 3; //configurations
    case users = 4; //users
    case audit = 5; //audit
    case about = 6; //about
    case approval = 7; //approval
    case activity = 8; //activity
}
