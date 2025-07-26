<?php

namespace Database\Seeders;

use App\Models\UserPermission;
use Illuminate\Database\Seeder;
use App\Models\UserPermissionSub;
use App\Enums\Permissions\RoleEnum;
use App\Enums\Permissions\PermissionEnum;
use App\Enums\Permissions\SubPermissionEnum;

class UserPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->superPermissions();
        $this->adminPermissions();
        $this->userPermissions();
        $this->debuggerPermissions();
    }

    public function superPermissions()
    {
        $userPermission = UserPermission::factory()->create([
            "view" => true,
            "edit" => true,
            "delete" => true,
            "add" => true,
            "user_id" => RoleEnum::super->value,
            "permission" => PermissionEnum::users
        ]);
        $this->addSubPermissions(SubPermissionEnum::USERS, $userPermission);

        $userPermission = UserPermission::factory()->create([
            "view" => true,
            "edit" => true,
            "delete" => true,
            "add" => true,
            "user_id" => RoleEnum::super->value,
            "permission" => PermissionEnum::about
        ]);
        $this->addSubPermissions(SubPermissionEnum::ABOUT, $userPermission);

        $userPermission = UserPermission::factory()->create([
            "view" => true,
            "edit" => true,
            "delete" => true,
            "add" => true,
            "user_id" => RoleEnum::super->value,
            "permission" => PermissionEnum::configurations
        ]);
        $this->addSubPermissions(SubPermissionEnum::CONFIGURATIONS, $userPermission);

        UserPermission::factory()->create([
            "view" => true,
            "edit" => true,
            "delete" => true,
            "add" => true,
            "user_id" => RoleEnum::super->value,
            "permission" => PermissionEnum::reports
        ]);
        UserPermission::factory()->create([
            "view" => true,
            "edit" => true,
            "delete" => true,
            "add" => true,
            "user_id" => RoleEnum::super->value,
            "permission" => PermissionEnum::audit
        ]);
        $userPermission = UserPermission::factory()->create([
            "view" => true,
            "edit" => true,
            "delete" => true,
            "add" => true,
            "user_id" => RoleEnum::super->value,
            "permission" => PermissionEnum::approval
        ]);
        $this->addSubPermissions(SubPermissionEnum::APPROVALS, $userPermission);

        $userPermission = UserPermission::factory()->create([
            "view" => true,
            "edit" => true,
            "delete" => true,
            "add" => true,
            "user_id" => RoleEnum::super->value,
            "permission" => PermissionEnum::activity
        ]);
        $this->addSubPermissions(SubPermissionEnum::ACTIVITY, $userPermission);
    }
    public function adminPermissions()
    {
        $userPermission = UserPermission::factory()->create([
            "view" => true,
            "edit" => true,
            "delete" => true,
            "add" => true,
            "user_id" => RoleEnum::admin->value,
            "permission" => PermissionEnum::users
        ]);
        $this->addSubPermissions(SubPermissionEnum::USERS, $userPermission);

        $userPermission = UserPermission::factory()->create([
            "view" => true,
            "edit" => true,
            "delete" => true,
            "add" => true,
            "user_id" => RoleEnum::admin->value,
            "permission" => PermissionEnum::about
        ]);
        $this->addSubPermissions(SubPermissionEnum::ABOUT, $userPermission);

        $userPermission = UserPermission::factory()->create([
            "view" => true,
            "edit" => true,
            "delete" => true,
            "add" => true,
            "user_id" => RoleEnum::admin->value,
            "permission" => PermissionEnum::configurations
        ]);
        $this->addSubPermissions(SubPermissionEnum::CONFIGURATIONS, $userPermission);

        UserPermission::factory()->create([
            "view" => true,
            "edit" => true,
            "delete" => true,
            "add" => true,
            "user_id" => RoleEnum::admin->value,
            "permission" => PermissionEnum::reports
        ]);
        $userPermission = UserPermission::factory()->create([
            "view" => true,
            "edit" => true,
            "delete" => true,
            "add" => true,
            "user_id" => RoleEnum::admin->value,
            "permission" => PermissionEnum::approval
        ]);
        $this->addSubPermissions(SubPermissionEnum::APPROVALS, $userPermission);

        $userPermission = UserPermission::factory()->create([
            "view" => true,
            "edit" => true,
            "delete" => true,
            "add" => true,
            "user_id" => RoleEnum::admin->value,
            "permission" => PermissionEnum::activity
        ]);
        $this->addSubPermissions(SubPermissionEnum::ACTIVITY, $userPermission);
    }
    public function userPermissions()
    {
        $userPermission = UserPermission::factory()->create([
            "view" => true,
            "edit" => true,
            "delete" => true,
            "add" => true,
            "user_id" => RoleEnum::user->value,
            "permission" => PermissionEnum::about
        ]);
        $this->addSubPermissions(SubPermissionEnum::USERS, $userPermission);

        $userPermission = UserPermission::factory()->create([
            "view" => true,
            "edit" => true,
            "delete" => true,
            "add" => true,
            "user_id" => RoleEnum::user->value,
            "permission" => PermissionEnum::configurations
        ]);
        $this->addSubPermissions(SubPermissionEnum::CONFIGURATIONS, $userPermission);

        UserPermission::factory()->create([
            "view" => true,
            "edit" => true,
            "delete" => true,
            "add" => true,
            "user_id" => RoleEnum::user->value,
            "permission" => PermissionEnum::reports
        ]);
    }
    public function debuggerPermissions()
    {
        UserPermission::factory()->create([
            "view" => true,
            "edit" => true,
            "delete" => true,
            "add" => true,
            "user_id" => RoleEnum::debugger->value,
            "permission" => PermissionEnum::logs
        ]);
    }

    private function addSubPermissions(array $group, $userPermission)
    {
        foreach ($group as $id => $meta) {
            UserPermissionSub::factory()->create([
                "edit" => true,
                "delete" => true,
                "add" => true,
                "view" => true,
                "is_category" => $meta['is_category'],
                "user_permission_id" => $userPermission->id,
                "sub_permission_id" => $id,
            ]);
        }
    }
}
