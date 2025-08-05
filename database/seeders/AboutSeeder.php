<?php

namespace Database\Seeders;

use App\Models\AboutStaff;
use App\Models\AboutStaffType;
use App\Models\SlideshowTrans;
use App\Models\AboutStaffTrans;
use Illuminate\Database\Seeder;
use App\Models\OfficeInformation;
use App\Enums\Types\AboutStaffEnum;
use App\Models\AboutStaffTypeTrans;
use App\Enums\Languages\LanguageEnum;
use App\Enums\Permissions\RoleEnum;
use App\Models\OfficeInformationTrans;
use App\Models\Slideshow;

class AboutSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    private $slideshows = [
        [
            'fa' => [
                'title' => 'مصاحبه برنامه‌نویسی: ۱۸۹ سوال و راه‌حل برنامه‌نویسی (مصاحبه و شغل)وميو دٸوس',
                'description' => 'زه استخدام کوونکی نه یم. زه یو سافټویر انجنیر یم. او په دې توګه، زه پوهیږم چې دا څه ډول دی چې له تاسو څخه وغوښتل شي چې په ځای کې غوره الګوریتمونه جوړ کړئ او بیا په سپینه تخته کې بې عیب کوډ ولیکئ. زه د یو نوماند او مرکه کونکي په توګه له دې څخه تیر شوی یم.
                    د کوډ کولو مرکې کریک کول، شپږمه نسخه دلته ده چې تاسو سره د دې پروسې له لارې مرسته وکړي، تاسو ته هغه څه درس درکوي چې تاسو ورته اړتیا لرئ پوه شئ او تاسو ته وړتیا درکوي چې په خپل غوره فعالیت کې کار وکړئ. ما د سلګونو سافټویر انجنیرانو روزنه او مرکې کړې دي. پایله دا کتاب دی.
                    زده کړئ چې څنګه په یوه پوښتنه کې اشارې او پټ توضیحات افشا کړئ، ومومئ چې څنګه ستونزه په اداره کیدونکو ټوټو وویشئ، تخنیکونه رامینځته کړئ ترڅو ځان خلاص کړئ کله چې بند پاتې شئ، د کمپیوټر ساینس اصلي مفکورې زده کړئ (یا بیا زده کړئ)، او د 189 مرکې پوښتنو او حلونو تمرین وکړئ.'
            ],
            'ps' => [
                'title' => 'د کوډ کولو مرکې ماتول: د پروګرام کولو ۱۸۹ پوښتنې او حل لارې (د مرکې او مسلک ماتول)',
                'description' => "من استخدام‌کننده نیستم. من یک مهندس نرم‌افزار هستم. و به همین دلیل، می‌دانم که از شما خواسته می‌شود الگوریتم‌های درخشان را درجا بنویسید و سپس کد بی‌عیب و نقصی را روی تخته سفید بنویسید. من این را به عنوان یک کاندیدا و به عنوان یک مصاحبه‌کننده تجربه کرده‌ام.
                    کتاب «شکستن مصاحبه کدنویسی، ویرایش ششم» اینجاست تا در این فرآیند به شما کمک کند، آنچه را که باید بدانید به شما آموزش دهد و شما را قادر سازد تا بهترین عملکرد خود را داشته باشید. من صدها مهندس نرم‌افزار را مربیگری و مصاحبه کرده‌ام. نتیجه این کتاب است.
                    یاد بگیرید که چگونه نکات و جزئیات پنهان یک سوال را کشف کنید، کشف کنید که چگونه یک مشکل را به بخش‌های قابل مدیریت تقسیم کنید، تکنیک‌هایی را برای رهایی از گیر افتادن در مصاحبه توسعه دهید، مفاهیم اصلی علوم کامپیوتر را یاد بگیرید (یا دوباره یاد بگیرید) و روی ۱۸۹ سوال و راه‌حل مصاحبه تمرین کنید."
            ],
            'en' => [
                'title' => 'Cracking the Coding Interview: 189 Programming Questions and Solutions (Cracking the Interview & Career)',
                'description' => "I am not a recruiter. I am a software engineer. And as such, I know what it's like to be asked to whip up brilliant algorithms on the spot and then write flawless code on a whiteboard. I've been through this as a candidate and as an interviewer.
                     Cracking the Coding Interview, 6th Edition is here to help you through this process, teaching you what you need to know and enabling you to perform at your very best. I've coached and interviewed hundreds of software engineers. The result is this book.
                     Learn how to uncover the hints and hidden details in a question, discover how to break down a problem into manageable chunks, develop techniques to unstick yourself when stuck, learn (or re-learn) core computer science concepts, and practice on 189 interview questions and solutions."
            ],
            'image' => 'https://m.media-amazon.com/images/I/61mIq2iJUXL._SY425_.jpg'
        ],
        [
            'fa' => [
                'title' => "مدیریت حافظه ++C: نوشتن کد ++C کم‌حجم‌تر و ایمن‌تر با استفاده از تکنیک‌های اثبات‌شده مدیریت حافظه",
                'description' => "++C به توسعه‌دهندگان قدرت بی‌نظیری در مدیریت حافظه می‌دهد، اما قدرت زیاد، مسئولیت زیادی نیز به همراه دارد. مدیریت ضعیف حافظه می‌تواند منجر به خرابی، تنگناهای عملکرد و آسیب‌پذیری‌های امنیتی شود.
                    چه روی سیستم‌های بلادرنگ، موتورهای بازی، برنامه‌های مالی یا دستگاه‌های تعبیه‌شده کار کنید، تسلط بر مدیریت حافظه برای ساخت نرم‌افزارهای قوی و با کارایی بالا ضروری است. این کتاب نگاهی عمیق به مدیریت حافظه مدرن ++C ارائه می‌دهد و هم اصول اساسی و هم تکنیک‌های پیشرفته مورد استفاده متخصصان برای بهینه‌سازی برنامه‌ها را پوشش می‌دهد. این کتاب شکاف بین دانش نظری و پیاده‌سازی عملی را پر می‌کند و تضمین می‌کند که شما نه تنها «چه چیزی» را درک می‌کنید، بلکه..."
            ],
            'ps' => [
                'title' => "د C++ حافظې مدیریت: د ثابت شوي حافظې مدیریت تخنیکونو په کارولو سره د C++ کوډ ډیر نرم او خوندي ولیکئ.",
                'description' => "د C++ حافظې مدیریت: د ثابت شوي حافظې مدیریت تخنیکونو په کارولو سره د C++ کوډ ډیر خوندي او خوندي ولیکئ',
                    'تفصیل' => 'C++ پراختیا کونکو ته د حافظې په اړه بې ساري ځواک ورکوي، مګر د لوی ځواک سره لوی مسؤلیت راځي. د حافظې ضعیف اداره کول کولی شي د کریشونو، فعالیت خنډونو، او امنیتي زیانونو لامل شي.
                     که تاسو په ریښتیني وخت سیسټمونو، د لوبې انجنونو، مالي غوښتنلیکونو، یا ایمبیډ شوي وسیلو کې کار کوئ، د حافظې مدیریت ماسټر کول د قوي او لوړ فعالیت سافټویر جوړولو لپاره اړین دا کتاب د عصري C++ حافظې مدیریت کې ژوره غوطه وړاندې کوي، دواړه بنسټیز اصول او پرمختللي تخنیکونه پوښي چې د متخصصینو لخوا د غوښتنلیکونو غوره کولو لپاره کارول کیږي. دا د تیوریکي پوهې او عملي پلي کولو ترمنځ تشه ډکوي، ډاډ ترلاسه کوي چې تاسو نه یوازې  پوهیږئ مګر/"
            ],
            'en' => [
                'title' => 'C++ Memory Management: Write leaner and safer C++ code using proven memory-management techniques',
                'description' => 'C++ gives developers unparalleled power over memory, but with great power comes great responsibility. Poor memory handling can lead to crashes, performance bottlenecks, and security vulnerabilities.
                     Whether you’re working on real-time systems, game engines, financial applications, or embedded devices, mastering memory management is essential to building robust and high-performance software. This book provides a deep dive into modern C++ memory management, covering both fundamental principles and advanced techniques used by experts to optimize applications. It bridges the gap between theoretical knowledge and practical implementation, ensuring that you not only understand the "what" but/'
            ],
            'image' => 'https://m.media-amazon.com/images/I/71Csss0+FWL._SY385_.jpg'
        ],
        [
            'fa' => [
                'title' => "راهنمای جیبی لینوکس: دستورات ضروری (راهنماهای جیبی لینوکس)",
                'description' => "اگر در کار روزمره خود از لینوکس استفاده می‌کنید، کتاب «راهنمای جیبی لینوکس» مرجع کاملی برای استفاده در محل کار است. این نسخه که به طور کامل در بیستمین سالگرد انتشار به‌روزرسانی شده است، بیش از ۲۰۰ دستور لینوکس، از جمله دستورات جدید برای مدیریت فایل، مدیریت بسته، کنترل نسخه، تبدیل فرمت فایل و موارد دیگر را توضیح می‌دهد.
                     در این راهنمای مختصر، نویسنده، دنیل برت، مفیدترین دستورات لینوکس را بر اساس عملکرد دسته‌بندی کرده است. چه تازه‌کار باشید و چه کاربر باتجربه، این کتاب کاربردی مرجعی ایده‌آل برای مهم‌ترین دستورات لینوکس است."
            ],
            'ps' => [
                'title' => "د لینکس پاکټ لارښود: اړین امرونه (د لینکس پاکټ لارښودونه)",
                'description' => 'که تاسو په خپل ورځني کار کې لینکس کاروئ، نو د لینکس پاکټ لارښود د دندې پرمهال یو مناسب حواله ده. دا په بشپړه توګه تازه شوی د شلمې کلیزې نسخه د 200 څخه ډیر لینکس قوماندې تشریح کوي، پشمول د فایل اداره کولو، د بسته بندۍ مدیریت، د نسخې کنټرول، د فایل فارمیټ تبادلو، او نورو لپاره نوي قوماندې.پدې لنډ لارښود کې، لیکوال ډینیل بیرټ د فعالیت له مخې ګروپ شوي خورا ګټور لینکس قوماندې چمتو کوي. که تاسو یو نوی یا تجربه لرونکی کارونکی یاست، دا عملي کتاب د خورا مهم لینکس قوماندې لپاره یو مثالی حواله ده.'
            ],
            'en' => [
                'title' => 'Linux Pocket Guide: Essential Commands (Linux Pocket Guides)',
                'description' => "If you use Linux in your day-to-day work, then Linux Pocket Guide is the perfect on-the-job reference. This thoroughly updated 20th anniversary edition explains more than 200 Linux commands, including new commands for file handling, package management, version control, file format conversions, and more.
                     In this concise guide, author Daniel Barrett provides the most useful Linux commands grouped by functionality. Whether you're a novice or an experienced user, this practical book is an ideal reference for the most important Linux commands."
            ],
            'image' => 'https://m.media-amazon.com/images/I/41jWjmIoJYL._SY445_SX342_.jpg'
        ],
    ];
    public function run(): void
    {
        $this->slideshows();
        $this->staffTypes();
        $this->officeInformation();
        $this->manager();
        $this->director();
        $this->technicalSupport();
    }
    public function slideshows()
    {
        foreach ($this->slideshows as $slideshowData) {
            // Save the main slideshow record
            $slideshow = Slideshow::create([
                'image' => $slideshowData['image'],
                'user_id' => RoleEnum::super->value,
            ]);

            // Loop through each language and insert the translations
            foreach (['fa', 'ps', 'en'] as $langCode) {

                SlideshowTrans::create([
                    'slideshow_id' => $slideshow->id,
                    'language_name' => $langCode,
                    'title' => $slideshowData[$langCode]['title'],
                    'description' => $slideshowData[$langCode]['description'],
                ]);
            }
        }
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
