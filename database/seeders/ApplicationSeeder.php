<?php

namespace Database\Seeders;

use App\Models\Application;
use Illuminate\Database\Seeder;
use App\Models\ApplicationTrans;
use App\Enums\Types\ApplicationEnum;

class ApplicationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $type = Application::create([
            "id" => ApplicationEnum::user_approval,
            "cast_to" => 'bool',
            "value" => 'true',
        ]);
        ApplicationTrans::create([
            "application_id" => $type->id,
            "language_name" => "en",
            "value" => "User Approval",
            "description" => 'When enabled, all newly registered users must be manually approved by you before they can log in or access the system.',
        ]);
        ApplicationTrans::create([
            "application_id" => $type->id,
            "language_name" => "fa",
            "value" => "تأیید کاربر",
            "description" => 'وقتی فعال باشد، همه کاربران تازه ثبت نام شده باید قبل از ورود یا دسترسی به سیستم، به صورت دستی توسط شما تأیید شوند.',
        ]);
        ApplicationTrans::create([
            "application_id" => $type->id,
            "language_name" => "ps",
            "value" => "د کارونکي تصویب",
            "description" => 'کله چې فعال شي، ټول نوي راجستر شوي کاروونکي باید په لاسي ډول ستاسو لخوا تصویب شي مخکې لدې چې دوی سیسټم ته ننوځي یا لاسرسی ومومي.',
        ]);
    }
}
