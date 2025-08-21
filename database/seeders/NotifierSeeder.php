<?php

namespace Database\Seeders;

use App\Models\NotifierType;
use Illuminate\Database\Seeder;
use App\Enums\Types\NotifierEnum;
use App\Models\NotifierTypeTrans;
use App\Enums\Languages\LanguageEnum;

class NotifierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $this->notifierType();
    }

    protected function notifierType()
    {
        $type = NotifierType::create([
            "id" => NotifierEnum::confirm_adding_user->value,
        ]);
        NotifierTypeTrans::create([
            'notifier_type_id' => $type->id,
            'value' => "Confirm adding user",
            'language_name' => LanguageEnum::default,
        ]);
        NotifierTypeTrans::create([
            'notifier_type_id' => $type->id,
            'value' => 'تایید اضافه کردن کاربر',
            'language_name' => LanguageEnum::farsi,
        ]);
        NotifierTypeTrans::create([
            'notifier_type_id' => $type->id,
            'value' => "د کارونکي اضافه کول تایید",
            'language_name' => LanguageEnum::pashto,
        ]);
    }
}
