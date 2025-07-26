<?php

namespace Database\Seeders;

use App\Models\Status;
use App\Models\StatusType;
use Illuminate\Database\Seeder;
use App\Enums\Statuses\StatusEnum;
use Illuminate\Support\Facades\DB;
use App\Enums\Types\StatusTypeEnum;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->statusType();
        $this->status();
    }
    public function statusType()
    {
        StatusType::create([
            'id' => StatusTypeEnum::blocking,
        ]);
    }
    public function status()
    {
        $statustype =  Status::create([
            'id' => StatusEnum::active,
            'status_type_id' => StatusTypeEnum::blocking,
        ]);
        DB::table('status_trans')->insert([
            'status_id' => $statustype->id,
            'language_name' => 'en',
            'name' => 'Active'

        ]);
        DB::table('status_trans')->insert([
            'status_id' => $statustype->id,
            'language_name' => 'fa',
            'name' => 'فعال'

        ]);
        DB::table('status_trans')->insert([
            'status_id' => $statustype->id,
            'language_name' => 'ps',
            'name' => 'فعال'
        ]);
        $statustype =  Status::create([
            'id' => StatusEnum::block,
            'status_type_id' => StatusTypeEnum::blocking,
        ]);
        DB::table('status_trans')->insert([
            'status_id' => $statustype->id,
            'language_name' => 'en',
            'name' => 'Block'

        ]);
        DB::table('status_trans')->insert([
            'status_id' => $statustype->id,
            'language_name' => 'fa',
            'name' => 'مسدود'

        ]);
        DB::table('status_trans')->insert([
            'status_id' => $statustype->id,
            'language_name' => 'ps',
            'name' => 'مسدود'
        ]);
    }
}
