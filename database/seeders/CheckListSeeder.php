<?php

namespace Database\Seeders;

use App\Models\CheckListType;
use Illuminate\Database\Seeder;
use App\Models\CheckListTypeTrans;
use App\Enums\Languages\LanguageEnum;
use App\Enums\Checklist\ChecklistEnum;

class CheckListSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->CheckListType();
    }

    protected function CheckListType()
    {
        $checklist = CheckListType::create([
            'id' => ChecklistEnum::user,
        ]);
        CheckListTypeTrans::create([
            'value' => "User",
            'check_list_type_id' => $checklist->id,
            'language_name' => LanguageEnum::default,
        ]);

        CheckListTypeTrans::create([
            'value' => "کاربر",
            'check_list_type_id' => $checklist->id,
            'language_name' => LanguageEnum::farsi,
        ]);
        CheckListTypeTrans::create([
            'value' => "کاروونکی",
            'check_list_type_id' => $checklist->id,
            'language_name' => LanguageEnum::pashto,
        ]);
    }
}
