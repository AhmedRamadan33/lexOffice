<?php

namespace Database\Seeders;

use App\Models\Branch;
use App\Models\User;
use Illuminate\Database\Seeder;

class DemoUserSeeder extends Seeder
{
    public function run(): void
    {
        $branchId = Branch::where('is_main', true)->value('id');

        $users = [
            [
                'name' => ['ar' => 'محمد الجندي', 'en' => 'Mohamed El-Guindy'],
                'email' => 'lawyer1@lexoffice.test',
                'role' => 'Lawyer',
                'category' => 'lawyers',
                'title' => ['ar' => 'محامٍ أول - قضايا جنائية', 'en' => 'Senior Lawyer - Criminal Cases'],
                'bio' => ['ar' => 'يتولى الدفاع في القضايا الجنائية المعقدة، ويتمتع بسجل حافل من الأحكام الناجحة لصالح موكليه.', 'en' => 'Handles defense in complex criminal cases, with a strong track record of successful rulings for his clients.'],
                'specialties' => ["ar" => "الدفاع الجنائي\nاستئناف الأحكام\nالقضايا الاقتصادية", "en" => "Criminal Defense\nSentence Appeals\nEconomic Crime Cases"],
                'education' => ["ar" => "دبلوم القانون الجنائي - جامعة عين شمس\nبكالوريوس الحقوق", "en" => "Diploma in Criminal Law - Ain Shams University\nLL.B."],
                'experience' => ["ar" => "وكيل نيابة سابق\nمحامٍ جنائي منذ 2016", "en" => "Former Deputy Prosecutor\nCriminal lawyer since 2016"],
            ],
            [
                'name' => ['ar' => 'سارة عبد الله', 'en' => 'Sara Abdullah'],
                'email' => 'lawyer2@lexoffice.test',
                'role' => 'Lawyer',
                'category' => 'lawyers',
                'title' => ['ar' => 'محامية أول - قانون العمل', 'en' => 'Senior Lawyer - Labor Law'],
                'bio' => ['ar' => 'تقدم للشركات والأفراد استشارات قانونية شاملة في مجال علاقات العمل وحل النزاعات العمالية.', 'en' => 'Provides comprehensive legal consultation to companies and individuals on employment relations and labor dispute resolution.'],
                'specialties' => ["ar" => "عقود العمل\nالفصل التعسفي\nالتحكيم العمالي", "en" => "Employment Contracts\nWrongful Termination\nLabor Arbitration"],
                'education' => ["ar" => "بكالوريوس الحقوق - جامعة الملك عبدالعزيز", "en" => "LL.B. - King Abdulaziz University"],
                'experience' => ["ar" => "مستشارة موارد بشرية وقانونية (2019-2023)", "en" => "HR & Legal Consultant (2019-2023)"],
            ],
            [
                'name' => ['ar' => 'أحمد فتحي', 'en' => 'Ahmed Fathy'],
                'email' => 'secretary@lexoffice.test',
                'role' => 'Secretary',
                'category' => 'admin_staff',
                'title' => ['ar' => 'سكرتير تنفيذي', 'en' => 'Executive Secretary'],
                'bio' => ['ar' => 'يتولى تنظيم مواعيد الجلسات ومتابعة المراسلات الإدارية بين المكتب وعملائه.', 'en' => "Manages hearing schedules and follows up on the firm's administrative correspondence with its clients."],
                'specialties' => null,
                'education' => ["ar" => "بكالوريوس إدارة أعمال - جامعة القاهرة", "en" => "B.A. in Business Administration - Cairo University"],
                'experience' => ["ar" => "يعمل بالمكتب منذ 2020", "en" => "With the firm since 2020"],
            ],
            [
                'name' => ['ar' => 'منى إبراهيم', 'en' => 'Mona Ibrahim'],
                'email' => 'accountant@lexoffice.test',
                'role' => 'Accountant',
                'category' => 'admin_staff',
                'title' => ['ar' => 'محاسبة أولى', 'en' => 'Senior Accountant'],
                'bio' => ['ar' => 'مسؤولة عن الشؤون المالية للمكتب ومتابعة الفواتير والمدفوعات مع العملاء.', 'en' => "Responsible for the firm's financial affairs and following up on client invoices and payments."],
                'specialties' => null,
                'education' => ["ar" => "بكالوريوس تجارة، شعبة محاسبة - جامعة عين شمس", "en" => "B.Com in Accounting - Ain Shams University"],
                'experience' => ["ar" => "خبرة 6 سنوات في المحاسبة المالية والإدارية", "en" => "6 years of experience in financial and administrative accounting"],
            ],
            [
                'name' => ['ar' => 'أحمد السعيد', 'en' => 'Ahmed El-Saeed'],
                'email' => 'partner1@lexoffice.test',
                'role' => 'Lawyer',
                'category' => 'partners',
                'title' => ['ar' => 'شريك مؤسس - قانون تجاري', 'en' => 'Founding Partner - Commercial Law'],
                'bio' => ['ar' => 'يتمتع أحمد بخبرة تزيد عن 12 عاماً في مجال القانون التجاري وتأسيس الشركات، وقاد فريق المكتب في العديد من صفقات الاستحواذ الكبرى.', 'en' => "Ahmed has over 12 years of experience in commercial law and company formation, leading the firm's team through numerous major acquisition deals."],
                'specialties' => ["ar" => "تأسيس الشركات\nالعقود التجارية\nالاندماج والاستحواذ", "en" => "Company Formation\nCommercial Contracts\nMergers & Acquisitions"],
                'education' => ["ar" => "ماجستير في القانون التجاري - جامعة الملك سعود\nبكالوريوس الحقوق - جامعة القاهرة", "en" => "LL.M. in Commercial Law - King Saud University\nLL.B. - Cairo University"],
                'experience' => ["ar" => "مستشار قانوني أول في شركة كبرى (2015-2020)\nمحاضر زائر في القانون التجاري", "en" => "Senior Legal Counsel at a major corporation (2015-2020)\nGuest lecturer in Commercial Law"],
            ],
            [
                'name' => ['ar' => 'سارة العتيبي', 'en' => 'Sarah Al-Otaibi'],
                'email' => 'partner2@lexoffice.test',
                'role' => 'Lawyer',
                'category' => 'partners',
                'title' => ['ar' => 'شريكة - أحوال شخصية', 'en' => 'Partner - Personal Status'],
                'bio' => ['ar' => 'متخصصة في قضايا الأسرة والأحوال الشخصية، وتُعرف بحرصها الشديد على مصلحة الأطفال في قضايا الحضانة.', 'en' => 'Specializes in family and personal-status cases, known for her strong focus on the best interests of children in custody matters.'],
                'specialties' => ["ar" => "قضايا الطلاق والحضانة\nالنفقة\nالميراث", "en" => "Divorce & Custody Cases\nAlimony\nInheritance"],
                'education' => ["ar" => "ماجستير في الأحوال الشخصية - جامعة الأزهر\nبكالوريوس الحقوق", "en" => "LL.M. in Personal Status Law - Al-Azhar University\nLL.B."],
                'experience' => ["ar" => "محامية بمكتب استشارات أسرية (2018-2022)", "en" => "Family law consultant (2018-2022)"],
            ],
        ];

        foreach ($users as $i => $data) {
            $user = User::factory()->create([
                'branch_id' => $branchId,
                'name' => $data['name'],
                'email' => $data['email'],
                'category' => $data['category'],
                'title' => $data['title'],
                'bio' => $data['bio'],
                'specialties' => $data['specialties'],
                'education' => $data['education'],
                'experience' => $data['experience'],
                'sort_order' => $i,
                'is_team_visible' => true,
            ]);

            $user->assignRole($data['role']);
        }
    }
}
