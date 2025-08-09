<?php

namespace Database\Seeders;

use App\Models\Gender;
use App\Models\GenderTrans;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Language;
use Illuminate\Database\Seeder;

/*
1. If you add new Role steps are:
    1. Add to following:
        - RoleEnum
        - RoleSeeder
        - RolePermissionSeeder (Define which permissions role can access)
        - Optional: Set Role on User go to JobAndUserSeeder Then UserPermissionSeeder


2. If you add new Permission steps are:
    1. Add to following:
        - PermissionEnum
        - SubPermissionEnum (In case has Sub Permissions)
        - PermissionSeeder
        - SubPermissionSeeder Then SubPermissionEnum (I has any sub permissions) 
        - RolePermissionSeeder (Define Which Role can access the permission)
        - Optional: Set Permission on User go to JobAndUserSeeder Then UserPermissionSeeder

        
3. If you add new Sub Permission steps are:
    1. Add to following:
        - SubPermissionEnum
        - SubPermissionSeeder
        - RolePermissionSeeder (Define Which Role can access the permission)
        - Optional: Set Permission on User go to JobAndUserSeeder Then UserPermissionSeeder
*/

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->languages();
        $this->gender();
        $this->call(CountrySeeder::class);
        $this->call(DivisionSeeder::class);
        $this->call(RoleSeeder::class);
        $this->call(StatusSeeder::class);
        $this->call(PermissionSeeder::class);
        $this->call(SubPermissionSeeder::class);
        $this->call(RolePermissionSeeder::class);
        $this->call(JobAndUserSeeder::class);
        $this->call(FaqSeeder::class);
        $this->call(CheckListSeeder::class);
        $this->call(AboutSeeder::class);
        $this->call(ApprovalSeeder::class);
        $this->call(NotifierSeeder::class);
        $this->call(ApplicationSeeder::class);
    }
    public function languages(): void
    {
        Language::factory()->create([
            "name" => "en"
        ]);
        Language::factory()->create([
            "name" => "ps"
        ]);
        Language::factory()->create([
            "name" => "fa"
        ]);
    }
    protected function gender()
    {
        $item = Gender::factory()->create([]);
        GenderTrans::factory()->create([
            "name" => "مرد",
            "language_name" => "fa",
            "gender_id" => $item->id
        ]);
        GenderTrans::factory()->create([
            "name" => "نارینه",
            "language_name" => "ps",
            "gender_id" => $item->id
        ]);
        GenderTrans::factory()->create([
            "name" => "Male",
            "language_name" => "en",
            "gender_id" => $item->id
        ]);
        $item = Gender::factory()->create([]);
        GenderTrans::factory()->create([
            "name" => "زن",
            "language_name" => "fa",
            "gender_id" => $item->id
        ]);
        GenderTrans::factory()->create([
            "name" => "ښځینه",
            "language_name" => "ps",
            "gender_id" => $item->id
        ]);
        GenderTrans::factory()->create([
            "name" => "Famale",
            "language_name" => "en",
            "gender_id" => $item->id
        ]);
    }
}
