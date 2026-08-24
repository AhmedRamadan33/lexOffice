<?php

namespace Database\Factories;

use App\Models\Branch;
use App\Models\CaseModel;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Task>
 */
class TaskFactory extends Factory
{
    private const ITEMS = [
        [
            'title' => ['ar' => 'إعداد مذكرة دفاع', 'en' => 'Prepare defense memorandum'],
            'description' => ['ar' => 'صياغة مذكرة الدفاع وتقديمها قبل الجلسة القادمة.', 'en' => 'Draft the defense memorandum and submit it before the next hearing.'],
        ],
        [
            'title' => ['ar' => 'حضور جلسة استئناف', 'en' => 'Attend appeal hearing'],
            'description' => ['ar' => 'الحضور أمام محكمة الاستئناف لمتابعة سير القضية.', 'en' => 'Attend the Court of Appeal to follow up on the case.'],
        ],
        [
            'title' => ['ar' => 'متابعة تنفيذ حكم قضائي', 'en' => 'Follow up on judgment execution'],
            'description' => ['ar' => 'التنسيق مع قلم المحضرين لتنفيذ الحكم الصادر.', 'en' => "Coordinate with the bailiff's office to execute the issued ruling."],
        ],
        [
            'title' => ['ar' => 'تجهيز ملف مستندات العميل', 'en' => 'Prepare client document file'],
            'description' => ['ar' => 'تجميع وترتيب كافة مستندات العميل الخاصة بالقضية.', 'en' => "Collect and organize all of the client's case-related documents."],
        ],
        [
            'title' => ['ar' => 'صياغة عقد بيع', 'en' => 'Draft a sale contract'],
            'description' => ['ar' => 'إعداد مسودة عقد البيع ومراجعتها مع العميل.', 'en' => 'Prepare the sale contract draft and review it with the client.'],
        ],
        [
            'title' => ['ar' => 'مراجعة عقد إيجار', 'en' => 'Review a lease agreement'],
            'description' => ['ar' => 'فحص بنود عقد الإيجار والتأكد من مطابقته للقانون.', 'en' => 'Examine the lease terms and ensure legal compliance.'],
        ],
        [
            'title' => ['ar' => 'التواصل مع الخبير القضائي', 'en' => 'Coordinate with court-appointed expert'],
            'description' => ['ar' => 'متابعة تقرير الخبرة المقدم في الدعوى.', 'en' => 'Follow up on the expert report submitted in the case.'],
        ],
        [
            'title' => ['ar' => 'تحصيل أتعاب متأخرة', 'en' => 'Collect overdue fees'],
            'description' => ['ar' => 'التواصل مع العميل لتحصيل الأتعاب المستحقة.', 'en' => 'Contact the client to collect outstanding fees.'],
        ],
        [
            'title' => ['ar' => 'تجديد توكيل قانوني', 'en' => 'Renew a legal power of attorney'],
            'description' => ['ar' => 'استخراج توكيل جديد من العميل لدى الشهر العقاري.', 'en' => 'Obtain a new power of attorney from the client at the notary office.'],
        ],
        [
            'title' => ['ar' => 'إعداد صحيفة دعوى', 'en' => 'Draft a statement of claim'],
            'description' => ['ar' => 'صياغة صحيفة الدعوى تمهيداً لقيدها بالمحكمة.', 'en' => 'Draft the statement of claim in preparation for filing with the court.'],
        ],
        [
            'title' => ['ar' => 'متابعة استلام حكم مكتوب', 'en' => 'Follow up on obtaining the written judgment'],
            'description' => ['ar' => 'استلام نسخة الحكم من قلم الكتاب.', 'en' => "Obtain a copy of the judgment from the court clerk's office."],
        ],
        [
            'title' => ['ar' => 'تحديث بيانات القضية على النظام', 'en' => 'Update case details in the system'],
            'description' => ['ar' => 'مراجعة وتحديث بيانات القضية بعد آخر جلسة.', 'en' => 'Review and update case data following the latest hearing.'],
        ],
    ];

    public function definition(): array
    {
        $item = fake()->unique()->randomElement(self::ITEMS);

        return [
            'branch_id' => fn () => Branch::query()->value('id'),
            'case_id' => fake()->optional(0.7)->randomElement(CaseModel::query()->pluck('id')->all() ?: [null]),
            'assigned_to' => fn () => auth()->id(),
            'assigned_by' => fn () => auth()->id(),
            'title' => $item['title'],
            'description' => $item['description'],
            'due_date' => fake()->dateTimeBetween('-1 month', '+2 months'),
            'status' => fake()->randomElement(['pending', 'in_progress', 'done']),
            'priority' => fake()->randomElement(['low', 'normal', 'high']),
        ];
    }
}
