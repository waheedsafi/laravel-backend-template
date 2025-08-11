<?php

namespace Database\Seeders;

use App\Models\RolePermission;
use Illuminate\Database\Seeder;
use App\Models\RolePermissionSub;
use App\Enums\Permissions\RoleEnum;
use App\Enums\Permissions\PermissionEnum;
use App\Enums\Permissions\SubPermissionEnum;
use App\Models\SubPermission;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->superPermissions();
        $this->administratorPermissions();
        $this->debuggerPermissions();
    }
    public function superPermissions()
    {
        $rolePer = RolePermission::factory()->create([
            "role" => RoleEnum::super,
            "permission" => PermissionEnum::users->value,
            'edit' => true,
            'delete' => true,
            'add' => true,
            'view' => true,
        ]);
        $this->addSubPermissions(SubPermissionEnum::USERS, $rolePer->id);

        $rolePer = RolePermission::factory()->create([
            "role" => RoleEnum::super,
            "permission" => PermissionEnum::configurations->value,
            'edit' => true,
            'delete' => true,
            'add' => true,
            'view' => true,
        ]);
        $this->addSubPermissions(SubPermissionEnum::CONFIGURATIONS, $rolePer->id);

        RolePermission::factory()->create([
            "role" => RoleEnum::super,
            "permission" => PermissionEnum::reports->value,
            'edit' => true,
            'delete' => true,
            'add' => true,
            'view' => true,
        ]);
        RolePermission::factory()->create([
            "role" => RoleEnum::super,
            "permission" => PermissionEnum::audit->value,
            'edit' => true,
            'delete' => true,
            'add' => true,
            'view' => true,
        ]);

        $rolePer = RolePermission::factory()->create([
            "role" => RoleEnum::super,
            "permission" => PermissionEnum::about->value,
            'edit' => true,
            'delete' => true,
            'add' => true,
            'view' => true,
        ]);
        $this->addSubPermissions(SubPermissionEnum::ABOUT, $rolePer->id);

        $rolePer = RolePermission::factory()->create([
            "role" => RoleEnum::super,
            "permission" => PermissionEnum::approval->value,
            'edit' => true,
            'delete' => true,
            'add' => true,
            'view' => true,
        ]);
        $this->addSubPermissions(SubPermissionEnum::APPROVALS, $rolePer->id);

        $rolePer = RolePermission::factory()->create([
            "role" => RoleEnum::super,
            "permission" => PermissionEnum::activity->value,
            'edit' => true,
            'delete' => true,
            'add' => true,
            'view' => true,
        ]);
        $this->addSubPermissions(SubPermissionEnum::ACTIVITY, $rolePer->id);
    }
    public function administratorPermissions()
    {
        $rolePer = RolePermission::factory()->create([
            "role" => RoleEnum::administrator,
            "permission" => PermissionEnum::users->value,
            'edit' => true,
            'delete' => true,
            'add' => true,
            'view' => true,
        ]);
        $this->addSubPermissions(SubPermissionEnum::USERS, $rolePer->id);

        $rolePer = RolePermission::factory()->create([
            "role" => RoleEnum::administrator,
            "permission" => PermissionEnum::configurations->value,
            'edit' => true,
            'delete' => true,
            'add' => true,
            'view' => true,
        ]);
        $this->addSubPermissions(SubPermissionEnum::CONFIGURATIONS, $rolePer->id);

        RolePermission::factory()->create([
            "role" => RoleEnum::administrator,
            "permission" => PermissionEnum::reports->value,
            'edit' => true,
            'delete' => true,
            'add' => true,
            'view' => true,
        ]);

        $rolePer = RolePermission::factory()->create([
            "role" => RoleEnum::administrator,
            "permission" => PermissionEnum::about->value,
            'edit' => true,
            'delete' => true,
            'add' => true,
            'view' => true,
        ]);
        $this->addSubPermissions(SubPermissionEnum::ABOUT, $rolePer->id);

        $rolePer = RolePermission::factory()->create([
            "role" => RoleEnum::administrator,
            "permission" => PermissionEnum::approval->value,
            'edit' => true,
            'delete' => true,
            'add' => true,
            'view' => true,
        ]);
        $this->addSubPermissions(SubPermissionEnum::APPROVALS, $rolePer->id);

        $rolePer = RolePermission::factory()->create([
            "role" => RoleEnum::administrator,
            "permission" => PermissionEnum::activity->value,
            'edit' => true,
            'delete' => true,
            'add' => true,
            'view' => true,
        ]);
        $this->addSubPermissions(SubPermissionEnum::ACTIVITY, $rolePer->id);
    }
    private function addSubPermissions(array $group, $role_permission_id)
    {
        foreach ($group as $id => $meta) {
            // This permssion belongs to IT
            if ($id !== SubPermissionEnum::about_technical->value) {
                RolePermissionSub::factory()->create([
                    "edit" => true,
                    "delete" => true,
                    "add" => true,
                    "view" => true,
                    "is_category" => $meta['is_category'],
                    "role_permission_id" => $role_permission_id,
                    "sub_permission_id" => $id,
                ]);
            }
        }
    }
    public function debuggerPermissions()
    {
        RolePermission::factory()->create([
            "role" => RoleEnum::debugger,
            "permission" => PermissionEnum::logs->value,
            'edit' => true,
            'delete' => true,
            'add' => true,
            'view' => true,
        ]);
        $rolePer = RolePermission::factory()->create([
            "role" => RoleEnum::debugger,
            "permission" => PermissionEnum::about->value,
            'edit' => true,
            'delete' => true,
            'add' => true,
            'view' => true,
        ]);
        RolePermissionSub::factory()->create([
            "edit" => true,
            "delete" => true,
            "add" => true,
            "view" => true,
            "is_category" => true,
            "role_permission_id" => $rolePer->id,
            "sub_permission_id" => SubPermissionEnum::about_technical->value,
        ]);
    }
}
