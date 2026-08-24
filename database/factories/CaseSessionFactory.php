<?php

namespace Database\Factories;

use App\Models\CaseModel;
use App\Models\Court;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CaseSession>
 */
class CaseSessionFactory extends Factory
{
    private const JUDGES = [
        ['ar' => 'المستشار محمد عبد العزيز', 'en' => 'Counselor Mohamed Abdel Aziz'],
        ['ar' => 'المستشار سامي الجندي', 'en' => 'Counselor Samy El-Guindy'],
        ['ar' => 'المستشارة نجلاء فتحي', 'en' => 'Counselor Naglaa Fathy'],
        ['ar' => 'المستشار هشام رأفت', 'en' => 'Counselor Hisham Raafat'],
        ['ar' => 'المستشار كمال الدين شعبان', 'en' => 'Counselor Kamal El-Din Shaaban'],
        ['ar' => 'المستشارة إيناس محروس', 'en' => 'Counselor Enas Mahrous'],
        ['ar' => 'المستشار عصام الحسيني', 'en' => 'Counselor Essam El-Husseiny'],
        ['ar' => 'المستشار رمزي عبد الوهاب', 'en' => 'Counselor Ramzy Abdel Wahab'],
    ];

    private const NOTES = [
        ['ar' => 'تم حضور محامي الخصم والمرافعة الشفوية.', 'en' => 'Opposing counsel attended and oral arguments were presented.'],
        ['ar' => 'طلب المدعى عليه أجلاً للرد على المذكرة.', 'en' => 'Defendant requested time to respond to the memorandum.'],
        ['ar' => 'تم تقديم حافظة مستندات جديدة.', 'en' => 'A new set of documents was submitted.'],
        ['ar' => 'الجلسة القادمة مخصصة لسماع الشهود.', 'en' => 'The next session is designated for witness testimony.'],
        ['ar' => 'تم استيفاء الرسوم القضائية المستحقة.', 'en' => 'Outstanding court fees have been settled.'],
        ['ar' => 'طلب الدفاع ضم مستندات إضافية للملف.', 'en' => 'The defense requested additional documents be added to the file.'],
    ];

    private const DECISIONS = [
        ['ar' => 'تأجلت الجلسة لتقديم مستندات إضافية.', 'en' => 'The hearing was postponed for submission of additional documents.'],
        ['ar' => 'حكمت المحكمة برفض الدعوى.', 'en' => 'The court ruled to dismiss the case.'],
        ['ar' => 'حكمت المحكمة بقبول الدعوى شكلاً ورفضها موضوعاً.', 'en' => 'The court accepted the case procedurally but rejected it on the merits.'],
        ['ar' => 'تأجلت الجلسة للنطق بالحكم.', 'en' => 'The hearing was adjourned for judgment to be pronounced.'],
        ['ar' => 'تقرر ندب خبير لبحث الدعوى.', 'en' => 'The court decided to appoint an expert to examine the case.'],
        ['ar' => 'حكمت المحكمة لصالح المدعي بالتعويض المطلوب.', 'en' => 'The court ruled in favor of the plaintiff for the requested compensation.'],
        ['ar' => 'تأجلت الجلسة لإعلان الخصم.', 'en' => 'The hearing was postponed to notify the opposing party.'],
        ['ar' => 'حجزت القضية للحكم بجلسة لاحقة.', 'en' => 'The case was reserved for judgment at a later session.'],
    ];

    public function definition(): array
    {
        $status = fake()->randomElement(['scheduled', 'held', 'postponed']);

        return [
            'case_id' => fn () => CaseModel::query()->inRandomOrder()->value('id'),
            'court_id' => fn () => Court::query()->inRandomOrder()->value('id'),
            'session_date' => fake()->dateTimeBetween('-3 months', '+1 month'),
            'session_time' => fake()->time('H:i'),
            'judge_name' => fake()->randomElement(self::JUDGES),
            'notes' => fake()->optional(0.4)->randomElement(self::NOTES) ?? ['ar' => null, 'en' => null],
            'decision' => $status === 'held'
                ? fake()->randomElement(self::DECISIONS)
                : ['ar' => null, 'en' => null],
            'next_session_date' => $status !== 'held' ? fake()->dateTimeBetween('now', '+2 months') : null,
            'status' => $status,
            'created_by' => fn () => auth()->id(),
        ];
    }
}
