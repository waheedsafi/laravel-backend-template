<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;
use App\Enums\Permissions\PermissionEnum;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Icons
        $users = 'icons/users-group.svg';
        $reports = 'icons/chart.svg';
        $configurations = 'icons/configurations.svg';
        $logs = 'icons/logs.svg';
        $audit = 'icons/audits.svg';
        $approval = 'icons/approval.svg';
        $activity = 'icons/activity.svg';
        $management = 'icons/management.svg';
        Permission::factory()->create([
            "id" => PermissionEnum::users->value,
            "icon" => $users,
            "name" => 'users',
            "priority" => 1,
        ]);
        Permission::factory()->create([
            "id" => PermissionEnum::about->value,
            "icon" => $management,
            "name" => 'management',
            "priority" => 2,
        ]);
        Permission::factory()->create([
            "id" => PermissionEnum::reports->value,
            "icon" => $reports,
            "name" => 'reports',
            "priority" => 3,
        ]);
        Permission::factory()->create([
            "id" => PermissionEnum::logs->value,
            "icon" => $logs,
            "name" => 'logs',
            "priority" => 4,
        ]);
        Permission::factory()->create([
            "id" => PermissionEnum::audit->value,
            "icon" => $audit,
            "name" => 'audit',
            "priority" => 5,
        ]);
        Permission::factory()->create([
            "id" => PermissionEnum::configurations->value,
            "icon" => $configurations,
            "name" => 'configurations',
            "priority" => 6,
        ]);
        Permission::factory()->create([
            "id" => PermissionEnum::approval->value,
            "icon" => $approval,
            "name" => 'approval',
            "priority" => 7,
        ]);
        Permission::factory()->create([
            "id" => PermissionEnum::activity->value,
            "icon" => $activity,
            "name" => 'activity',
            "priority" => 8,
        ]);
    }
}
