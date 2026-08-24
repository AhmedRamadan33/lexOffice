<?php

namespace Database\Seeders;

use App\Models\TeamMember;
use Illuminate\Database\Seeder;

class TeamMemberSeeder extends Seeder
{
    public function run(): void
    {
        $members = [
            [
                'name' => ['ar' => 'أحمد السعيد', 'en' => 'Ahmed El-Saeed'],
                'title' => ['ar' => 'شريك مؤسس - قانون تجاري', 'en' => 'Founding Partner - Commercial Law'],
                'bio' => ['ar' => 'يتمتع أحمد بخبرة تزيد عن 12 عاماً في مجال القانون التجاري وتأسيس الشركات، وقاد فريق المكتب في العديد من صفقات الاستحواذ الكبرى.', 'en' => 'Ahmed has over 12 years of experience in commercial law and company formation, leading the firm\'s team through numerous major acquisition deals.'],
                'specialties' => ["ar" => "تأسيس الشركات\nالعقود التجارية\nالاندماج والاستحواذ", "en" => "Company Formation\nCommercial Contracts\nMergers & Acquisitions"],
                'education' => ["ar" => "ماجستير في القانون التجاري - جامعة الملك سعود\nبكالوريوس الحقوق - جامعة القاهرة", "en" => "LL.M. in Commercial Law - King Saud University\nLL.B. - Cairo University"],
                'experience' => ["ar" => "مستشار قانوني أول في شركة كبرى (2015-2020)\nمحاضر زائر في القانون التجاري", "en" => "Senior Legal Counsel at a major corporation (2015-2020)\nGuest lecturer in Commercial Law"],
                'category' => 'corporate',
                'is_featured' => true,
            ],
            [
                'name' => ['ar' => 'سارة العتيبي', 'en' => 'Sarah Al-Otaibi'],
                'title' => ['ar' => 'محامية أول - أحوال شخصية', 'en' => 'Senior Lawyer - Personal Status'],
                'bio' => ['ar' => 'متخصصة في قضايا الأسرة والأحوال الشخصية، وتُعرف بحرصها الشديد على مصلحة الأطفال في قضايا الحضانة.', 'en' => 'Specializes in family and personal-status cases, known for her strong focus on the best interests of children in custody matters.'],
                'specialties' => ["ar" => "قضايا الطلاق والحضانة\nالنفقة\nالميراث", "en" => "Divorce & Custody Cases\nAlimony\nInheritance"],
                'education' => ["ar" => "ماجستير في الأحوال الشخصية - جامعة الأزهر\nبكالوريوس الحقوق", "en" => "LL.M. in Personal Status Law - Al-Azhar University\nLL.B."],
                'experience' => ["ar" => "محامية بمكتب استشارات أسرية (2018-2022)", "en" => "Family law consultant (2018-2022)"],
                'category' => 'personal_status',
                'is_featured' => true,
            ],
            [
                'name' => ['ar' => 'محمد الشامي', 'en' => 'Mohamed Al-Shami'],
                'title' => ['ar' => 'محامي أول - قضايا جنائية', 'en' => 'Senior Lawyer - Criminal Cases'],
                'bio' => ['ar' => 'يتولى الدفاع في القضايا الجنائية المعقدة، ويتمتع بسجل حافل من الأحكام الناجحة لصالح موكليه.', 'en' => 'Handles defense in complex criminal cases, with a strong track record of successful rulings for his clients.'],
                'specialties' => ["ar" => "الدفاع الجنائي\nاستئناف الأحكام\nالقضايا الاقتصادية", "en" => "Criminal Defense\nSentence Appeals\nEconomic Crime Cases"],
                'education' => ["ar" => "دبلوم القانون الجنائي - جامعة عين شمس\nبكالوريوس الحقوق", "en" => "Diploma in Criminal Law - Ain Shams University\nLL.B."],
                'experience' => ["ar" => "وكيل نيابة سابق\nمحامٍ جنائي منذ 2016", "en" => "Former Deputy Prosecutor\nCriminal lawyer since 2016"],
                'category' => 'criminal',
                'is_featured' => true,
            ],
            [
                'name' => ['ar' => 'نورا الخطيب', 'en' => 'Nora Al-Khatib'],
                'title' => ['ar' => 'محامية أول - قانون العمل', 'en' => 'Senior Lawyer - Labor Law'],
                'bio' => ['ar' => 'تقدم للشركات والأفراد استشارات قانونية شاملة في مجال علاقات العمل وحل النزاعات العمالية.', 'en' => 'Provides comprehensive legal consultation to companies and individuals on employment relations and labor dispute resolution.'],
                'specialties' => ["ar" => "عقود العمل\nالفصل التعسفي\nالتحكيم العمالي", "en" => "Employment Contracts\nWrongful Termination\nLabor Arbitration"],
                'education' => ["ar" => "بكالوريوس الحقوق - جامعة الملك عبدالعزيز", "en" => "LL.B. - King Abdulaziz University"],
                'experience' => ["ar" => "مستشارة موارد بشرية وقانونية (2019-2023)", "en" => "HR & Legal Consultant (2019-2023)"],
                'category' => 'labor',
                'is_featured' => false,
            ],
            [
                'name' => ['ar' => 'خالد المصري', 'en' => 'Khaled Al-Masry'],
                'title' => ['ar' => 'محامٍ - عقارات وأراضٍ', 'en' => 'Lawyer - Real Estate & Land'],
                'bio' => ['ar' => 'يتولى ملفات النزاعات العقارية وتوثيق عقود البيع والإيجار للأفراد والمستثمرين.', 'en' => 'Handles real-estate dispute files and documents sale/lease contracts for individuals and investors.'],
                'specialties' => ["ar" => "نزاعات الملكية\nعقود الإيجار\nالتوثيق العقاري", "en" => "Ownership Disputes\nLease Contracts\nProperty Documentation"],
                'education' => ["ar" => "بكالوريوس الحقوق - جامعة الإسكندرية", "en" => "LL.B. - Alexandria University"],
                'experience' => ["ar" => "محامٍ عقاري منذ 2017", "en" => "Real-estate lawyer since 2017"],
                'category' => 'real_estate',
                'is_featured' => false,
            ],
            [
                'name' => ['ar' => 'منى الفهد', 'en' => 'Mona Al-Fahad'],
                'title' => ['ar' => 'مستشارة قانونية - تحكيم', 'en' => 'Legal Consultant - Arbitration'],
                'bio' => ['ar' => 'خبيرة في التحكيم التجاري وتسوية المنازعات الودية بين الشركاء والشركات.', 'en' => 'Expert in commercial arbitration and amicable dispute resolution between partners and companies.'],
                'specialties' => ["ar" => "التحكيم التجاري\nتسوية المنازعات\nالوساطة", "en" => "Commercial Arbitration\nDispute Settlement\nMediation"],
                'education' => ["ar" => "ماجستير في تسوية المنازعات - جامعة الملك سعود", "en" => "LL.M. in Dispute Resolution - King Saud University"],
                'experience' => ["ar" => "محكّمة معتمدة لدى مركز التحكيم التجاري", "en" => "Accredited arbitrator at the Commercial Arbitration Center"],
                'category' => 'arbitration',
                'is_featured' => false,
            ],
        ];

        foreach ($members as $i => $member) {
            TeamMember::firstOrCreate(
                ['name->ar' => $member['name']['ar']],
                [...$member, 'sort_order' => $i, 'is_active' => true]
            );
        }
    }
}
