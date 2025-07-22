<?php

namespace Database\Seeders;

use App\Models\SubPermission;
use Illuminate\Database\Seeder;
use App\Enums\Permissions\PermissionEnum;
use App\Enums\Permissions\SubPermissionEnum;

class SubPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->subUserPermissions();
        $this->subConfigurationsPermissions();
        $this->subAboutPermissions();
        $this->subApprovalPermissions();
        $this->subActivityPermissions();
    }
    public function subUserPermissions()
    {
        foreach (SubPermissionEnum::USERS as $id => $role) {
            SubPermission::factory()->create([
                "id" => $id,
                "permission" => PermissionEnum::users->value,
                "name" => $role,
            ]);
        }
    }

    public function subConfigurationsPermissions()
    {
        foreach (SubPermissionEnum::CONFIGURATIONS as $id => $role) {
            SubPermission::factory()->create([
                "id" => $id,
                "permission" => PermissionEnum::configurations->value,
                "name" => $role,
            ]);
        }
    }
    public function subAboutPermissions()
    {
        foreach (SubPermissionEnum::ABOUT as $id => $role) {
            SubPermission::factory()->create([
                "id" => $id,
                "permission" => PermissionEnum::about->value,
                "name" => $role,
            ]);
        }
    }
    public function subApprovalPermissions()
    {
        foreach (SubPermissionEnum::APPROVALS as $id => $role) {
            SubPermission::factory()->create([
                "id" => $id,
                "permission" => PermissionEnum::approval->value,
                "name" => $role,
            ]);
        }
    }
    public function subActivityPermissions()
    {
        foreach (SubPermissionEnum::ACTIVITY as $id => $role) {
            SubPermission::factory()->create([
                "id" => $id,
                "permission" => PermissionEnum::activity->value,
                "name" => $role,
            ]);
        }
    }
}
