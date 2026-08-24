<?php

namespace Database\Factories;

use App\Models\Branch;
use App\Models\CaseType;
use App\Models\Client;
use App\Models\Court;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CaseModel>
 */
class CaseModelFactory extends Factory
{
    private const OPPONENTS = [
        ['ar' => 'سامح رفعت جرجس', 'en' => 'Sameh Rifaat Guirguis'],
        ['ar' => 'علياء منير توفيق', 'en' => 'Alia Mounir Tawfik'],
        ['ar' => 'حسام الدين عزت', 'en' => 'Hossam El-Din Ezzat'],
        ['ar' => 'شيرين ماجد لطفي', 'en' => 'Shereen Maged Lotfy'],
        ['ar' => 'باسم رأفت الديب', 'en' => 'Bassem Raafat El-Deeb'],
        ['ar' => 'إيمان صبحي زكي', 'en' => 'Eman Sobhy Zaki'],
        ['ar' => 'مصطفى جمال حلمي', 'en' => 'Mostafa Gamal Helmy'],
        ['ar' => 'سلمى وجدي عبد الغني', 'en' => 'Salma Wagdy Abdel Ghany'],
        ['ar' => 'عادل فوزي متولي', 'en' => 'Adel Fawzy Metwally'],
        ['ar' => 'ليلى شوقي البنا', 'en' => 'Laila Shawky El-Banna'],
        ['ar' => 'رامي عصام الديب', 'en' => 'Rami Essam El-Deeb'],
        ['ar' => 'فاطمة الزهراء نصر', 'en' => 'Fatma El-Zahraa Nasr'],
    ];

    private const SUBJECTS = [
        ['ar' => 'نزاع تجاري بخصوص عقد توريد بضائع', 'en' => 'Commercial dispute over a goods supply contract'],
        ['ar' => 'دعوى مطالبة بأجرة متأخرة عن عين مؤجرة', 'en' => 'Claim for overdue rent on a leased property'],
        ['ar' => 'قضية حضانة أطفال بعد الطلاق', 'en' => 'Child custody case following divorce'],
        ['ar' => 'دعوى فسخ عقد بيع عقار', 'en' => 'Lawsuit to rescind a property sale contract'],
        ['ar' => 'مطالبة بتعويض عن إصابة عمل', 'en' => 'Claim for compensation over a workplace injury'],
        ['ar' => 'نزاع على ملكية أرض زراعية', 'en' => 'Dispute over ownership of agricultural land'],
        ['ar' => 'دعوى إخلاء محل تجاري لعدم سداد الأجرة', 'en' => 'Eviction lawsuit for a commercial unit over unpaid rent'],
        ['ar' => 'قضية نصب واحتيال', 'en' => 'Fraud and embezzlement case'],
        ['ar' => 'مطالبة مالية بقيمة شيكات بدون رصيد', 'en' => 'Financial claim for bounced cheques'],
        ['ar' => 'دعوى فصل تعسفي من العمل', 'en' => 'Wrongful termination lawsuit'],
        ['ar' => 'نزاع بين شركاء حول توزيع الأرباح', 'en' => 'Dispute between partners over profit distribution'],
        ['ar' => 'دعوى تثبيت ملكية شقة سكنية', 'en' => 'Lawsuit to establish ownership of a residential apartment'],
        ['ar' => 'مطالبة بفسخ عقد مقاولة لعدم إتمام الأعمال', 'en' => 'Claim to terminate a contracting agreement over incomplete works'],
        ['ar' => 'قضية إشهار إفلاس تجاري', 'en' => 'Commercial bankruptcy declaration case'],
    ];

    private const NOTES = [
        ['ar' => 'تم تقديم المستندات الأصلية للمحكمة.', 'en' => 'Original documents have been submitted to the court.'],
        ['ar' => 'العميل يطلب تسوية ودية قبل نظر الجلسة القادمة.', 'en' => 'Client requests an amicable settlement before the next hearing.'],
        ['ar' => 'جاري التواصل مع الخصم لمناقشة تسوية.', 'en' => 'Coordination with the opposing party is underway to discuss a settlement.'],
        ['ar' => 'تم تكليف خبير حسابي لبحث الدعوى.', 'en' => 'An accounting expert has been assigned to examine the case.'],
        ['ar' => 'القضية منظورة أمام دائرة الاستئناف حالياً.', 'en' => 'The case is currently before the Court of Appeal.'],
        ['ar' => 'العميل يطلب متابعة أسبوعية لمستجدات القضية.', 'en' => 'Client requested weekly updates on case progress.'],
        ['ar' => 'تم إخطار الخصم رسمياً بموعد الجلسة القادمة.', 'en' => 'The opposing party has been officially notified of the next hearing date.'],
        ['ar' => 'القضية مرتبطة بدعوى أخرى منظورة أمام نفس الدائرة.', 'en' => 'The case is linked to another lawsuit before the same circuit.'],
    ];

    public function definition(): array
    {
        return [
            'branch_id' => fn () => Branch::query()->value('id'),
            'case_number' => 'C-'.now()->year.'-'.fake()->unique()->numerify('####'),
            'client_id' => fn () => Client::query()->inRandomOrder()->value('id'),
            'court_id' => fn () => Court::query()->inRandomOrder()->value('id'),
            'case_type_id' => fn () => CaseType::query()->inRandomOrder()->value('id'),
            'opponent_name' => fake()->unique()->randomElement(self::OPPONENTS),
            'opponent_phone' => '01'.fake()->randomElement([0, 1, 2, 5]).fake()->numerify('########'),
            'subject' => fake()->unique()->randomElement(self::SUBJECTS),
            'status' => fake()->randomElement(['open', 'pending', 'closed']),
            'assigned_lawyer_id' => fn () => auth()->id(),
            'start_date' => fake()->dateTimeBetween('-1 year', 'now'),
            'notes' => fake()->optional(0.4)->randomElement(self::NOTES) ?? ['ar' => null, 'en' => null],
            'created_by' => fn () => auth()->id(),
        ];
    }
}
