<?php

namespace Database\Seeders;

use App\Models\RolePermission;
use Illuminate\Database\Seeder;
use App\Models\RolePermissionSub;
use App\Enums\Permissions\RoleEnum;
use App\Enums\Permissions\PermissionEnum;
use App\Enums\Permissions\SubPermissionEnum;

class RolePermissionSeeder extends Seeder
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
        $rolePer = RolePermission::factory()->create([
            "role" => RoleEnum::super,
            "permission" => PermissionEnum::users->value
        ]);
        $this->rolePermissionSubUser($rolePer->id);
        $rolePer = RolePermission::factory()->create([
            "role" => RoleEnum::super,
            "permission" => PermissionEnum::configurations->value
        ]);
        $this->rolePermissionSubConfigurations($rolePer->id);

        RolePermission::factory()->create([
            "role" => RoleEnum::super,
            "permission" => PermissionEnum::reports->value
        ]);
        RolePermission::factory()->create([
            "role" => RoleEnum::super,
            "permission" => PermissionEnum::audit->value
        ]);

        $rolePer = RolePermission::factory()->create([
            "role" => RoleEnum::super,
            "permission" => PermissionEnum::about->value
        ]);
        $this->rolePermissionSubAbout($rolePer->id);
        $rolePer = RolePermission::factory()->create([
            "role" => RoleEnum::super,
            "permission" => PermissionEnum::approval->value
        ]);
        $this->rolePermissionSubApproval($rolePer->id);
        $rolePer = RolePermission::factory()->create([
            "role" => RoleEnum::super,
            "permission" => PermissionEnum::activity->value
        ]);
        $this->rolePermissionSubActivity($rolePer->id);
    }
    public function adminPermissions()
    {
        $rolePer = RolePermission::factory()->create([
            "role" => RoleEnum::admin,
            "permission" => PermissionEnum::users->value
        ]);
        $this->rolePermissionSubUser($rolePer->id);
        $rolePer = RolePermission::factory()->create([
            "role" => RoleEnum::admin,
            "permission" => PermissionEnum::configurations->value
        ]);
        $this->rolePermissionSubConfigurations($rolePer->id);

        RolePermission::factory()->create([
            "role" => RoleEnum::admin,
            "permission" => PermissionEnum::reports->value
        ]);

        $rolePer = RolePermission::factory()->create([
            "role" => RoleEnum::admin,
            "permission" => PermissionEnum::about->value
        ]);
        $this->rolePermissionSubAbout($rolePer->id);
        $rolePer = RolePermission::factory()->create([
            "role" => RoleEnum::admin,
            "permission" => PermissionEnum::approval->value
        ]);
        $this->rolePermissionSubApproval($rolePer->id);
        $rolePer = RolePermission::factory()->create([
            "role" => RoleEnum::admin,
            "permission" => PermissionEnum::activity->value
        ]);
        $this->rolePermissionSubActivity($rolePer->id);
    }
    public function userPermissions()
    {
        $rolePer = RolePermission::factory()->create([
            "role" => RoleEnum::user,
            "permission" => PermissionEnum::configurations->value
        ]);
        $this->rolePermissionSubConfigurations($rolePer->id);

        RolePermission::factory()->create([
            "role" => RoleEnum::user,
            "permission" => PermissionEnum::reports->value
        ]);

        $rolePer = RolePermission::factory()->create([
            "role" => RoleEnum::user,
            "permission" => PermissionEnum::about->value
        ]);
        $this->rolePermissionSubAbout($rolePer->id);
    }
    public function debuggerPermissions()
    {
        RolePermission::factory()->create([
            "role" => RoleEnum::debugger,
            "permission" => PermissionEnum::logs->value
        ]);
    }

    public function rolePermissionSubUser($role_permission_id)
    {
        foreach (SubPermissionEnum::USERS as $id => $role) {
            RolePermissionSub::factory()->create([
                "role_permission_id" => $role_permission_id,
                "sub_permission_id" => $id
            ]);
        }
    }


    public function rolePermissionSubConfigurations($role_permission_id)
    {
        foreach (SubPermissionEnum::CONFIGURATIONS as $id => $role) {
            RolePermissionSub::factory()->create([
                "role_permission_id" => $role_permission_id,
                "sub_permission_id" => $id
            ]);
        }
    }

    public function rolePermissionSubAbout($role_permission_id)
    {
        foreach (SubPermissionEnum::ABOUT as $id => $role) {
            RolePermissionSub::factory()->create([
                "role_permission_id" => $role_permission_id,
                "sub_permission_id" => $id
            ]);
        }
    }
    public function rolePermissionSubApproval($role_permission_id)
    {
        foreach (SubPermissionEnum::APPROVALS as $id => $role) {
            RolePermissionSub::factory()->create([
                "role_permission_id" => $role_permission_id,
                "sub_permission_id" => $id
            ]);
        }
    }
    public function rolePermissionSubActivity($role_permission_id)
    {
        foreach (SubPermissionEnum::ACTIVITY as $id => $role) {
            RolePermissionSub::factory()->create([
                "role_permission_id" => $role_permission_id,
                "sub_permission_id" => $id
            ]);
        }
    }
}
