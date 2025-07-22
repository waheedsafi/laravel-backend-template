<?php

namespace Database\Seeders;

use App\Models\AboutStaff;
use App\Models\AboutStaffType;
use App\Models\AboutStaffTrans;
use Illuminate\Database\Seeder;
use App\Models\OfficeInformation;
use App\Enums\Types\AboutStaffEnum;
use App\Models\AboutStaffTypeTrans;
use App\Models\OfficeInformationTrans;

class AboutSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->staffTypes();
        $this->officeInformation();
        $this->manager();
        $this->director();
        $this->technicalSupport();
    }
    public function staffTypes()
    {
        $item = AboutStaffType::factory()->create([
            'id' => AboutStaffEnum::manager,
        ]);
        AboutStaffTypeTrans::factory()->create([
            "value" => "مدیر",
            "language_name" => "fa",
            "about_staff_type_id" => $item->id
        ]);
        AboutStaffTypeTrans::factory()->create([
            "value" => "مدیر",
            "language_name" => "ps",
            "about_staff_type_id" => $item->id
        ]);
        AboutStaffTypeTrans::factory()->create([
            "value" => "Manager",
            "language_name" => "en",
            "about_staff_type_id" => $item->id
        ]);
        $item = AboutStaffType::factory()->create([
            'id' => AboutStaffEnum::director,
        ]);
        AboutStaffTypeTrans::factory()->create([
            "value" => "رئیس",
            "language_name" => "fa",
            "about_staff_type_id" => $item->id
        ]);
        AboutStaffTypeTrans::factory()->create([
            "value" => "رئیس",
            "language_name" => "ps",
            "about_staff_type_id" => $item->id
        ]);
        AboutStaffTypeTrans::factory()->create([
            "value" => "Director",
            "language_name" => "en",
            "about_staff_type_id" => $item->id
        ]);

        $item = AboutStaffType::factory()->create([
            'id' => AboutStaffEnum::technical_support,
        ]);
        AboutStaffTypeTrans::factory()->create([
            "value" => "پشتیبانی فنی",
            "language_name" => "fa",
            "about_staff_type_id" => $item->id
        ]);
        AboutStaffTypeTrans::factory()->create([
            "value" => "پشتیبانی فنی",
            "language_name" => "ps",
            "about_staff_type_id" => $item->id
        ]);
        AboutStaffTypeTrans::factory()->create([
            "value" => "Technical Support",
            "language_name" => "en",
            "about_staff_type_id" => $item->id
        ]);
    }
    public function officeInformation()
    {
        $item = OfficeInformation::factory()->create([
            "contact" => "+93202301374",
            "email" => "info.access@moph.gov.af",
        ]);
        OfficeInformationTrans::factory()->create([
            "value" => "چهار راهی صحت عامه، جاده وزیرمحمد اکبر خان، کابل، افغانستان",
            "language_name" => "fa",
            "office_information_id" => $item->id
        ]);
        OfficeInformationTrans::factory()->create([
            "value" => "د عامې روغتيا څلور لارې، د وزیرمحمد اکبر خان سرک ، کابل، افغانستان",
            "language_name" => "ps",
            "office_information_id" => $item->id
        ]);
        OfficeInformationTrans::factory()->create([
            "value" => "Sehat-e-Ama Square, Wazir Akbar khan Road, Kabul, Afghanistan",
            "language_name" => "en",
            "office_information_id" => $item->id
        ]);
    }
    public function manager()
    {
        $item = AboutStaff::factory()->create([
            "about_staff_type_id" => AboutStaffEnum::manager,
            "contact" => "+93202301375",
            "email" => "manager@moph.gov.af",
            "profile" => 'images/technical/general.jpg',
        ]);
        AboutStaffTrans::factory()->create([
            "name" => "مدیر",
            "language_name" => "fa",
            "about_staff_id" => $item->id
        ]);
        AboutStaffTrans::factory()->create([
            "name" => "مدیر",
            "language_name" => "ps",
            "about_staff_id" => $item->id
        ]);
        AboutStaffTrans::factory()->create([
            "name" => "Manager",
            "language_name" => "en",
            "about_staff_id" => $item->id
        ]);
    }
    public function director()
    {
        $item = AboutStaff::factory()->create([
            "about_staff_type_id" => AboutStaffEnum::director,
            "contact" => "+93202301376",
            "email" => "director@moph.gov.af",
            "profile" => 'images/technical/general.jpg',
        ]);
        AboutStaffTrans::factory()->create([
            "name" => "رئیس",
            "language_name" => "fa",
            "about_staff_id" => $item->id
        ]);
        AboutStaffTrans::factory()->create([
            "name" => "رئیس",
            "language_name" => "ps",
            "about_staff_id" => $item->id
        ]);
        AboutStaffTrans::factory()->create([
            "name" => "Director",
            "language_name" => "en",
            "about_staff_id" => $item->id
        ]);
    }
    public function technicalSupport()
    {
        // 1.
        $item = AboutStaff::factory()->create([
            "about_staff_type_id" => AboutStaffEnum::technical_support,
            "contact" => "+93785764809",
            "email" => "sayednaweedsayedy@gmail.com",
            "profile" => 'images/technical/sayed_naweed.jpg',
        ]);
        AboutStaffTrans::factory()->create([
            "name" => "سید نوید (توسعه دهنده نرم افزار)",
            "language_name" => "fa",
            "about_staff_id" => $item->id
        ]);
        AboutStaffTrans::factory()->create([
            "name" => "سید نوید (د سافټویر جوړونکی)",
            "language_name" => "ps",
            "about_staff_id" => $item->id
        ]);
        AboutStaffTrans::factory()->create([
            "name" => "Sayed Naweed (Software Developer)",
            "language_name" => "en",
            "about_staff_id" => $item->id
        ]);
        // 2.
        $item = AboutStaff::factory()->create([
            "about_staff_type_id" => AboutStaffEnum::technical_support,
            "contact" => "+93773757829",
            "email" => "jalalbakhti@gmail.com",
            "profile" => 'images/technical/jalal.jpg',
        ]);
        AboutStaffTrans::factory()->create([
            "name" => " جلال بختی (توسعه دهنده نرم افزار)",
            "language_name" => "fa",
            "about_staff_id" => $item->id
        ]);
        AboutStaffTrans::factory()->create([
            "name" => " جلال بختی (د سافټویر جوړونکی)",
            "language_name" => "ps",
            "about_staff_id" => $item->id
        ]);
        AboutStaffTrans::factory()->create([
            "name" => "Jalal Bakhti (Software Developer)",
            "language_name" => "en",
            "about_staff_id" => $item->id
        ]);
    }
}
