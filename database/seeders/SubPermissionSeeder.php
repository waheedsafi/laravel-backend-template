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
        $this->seedSubPermissions(SubPermissionEnum::USERS, PermissionEnum::users);
        $this->seedSubPermissions(SubPermissionEnum::CONFIGURATIONS, PermissionEnum::configurations);
        $this->seedSubPermissions(SubPermissionEnum::ABOUT, PermissionEnum::about);
        $this->seedSubPermissions(SubPermissionEnum::APPROVALS, PermissionEnum::approval);
        $this->seedSubPermissions(SubPermissionEnum::ACTIVITY, PermissionEnum::activity);
    }
    private function seedSubPermissions(array $group, PermissionEnum $permission): void
    {
        foreach ($group as $id => $meta) {
            SubPermission::factory()->create([
                'id' => $id,
                'permission' => $permission->value,
                'name' => $meta['label'],
            ]);
        }
    }
}
