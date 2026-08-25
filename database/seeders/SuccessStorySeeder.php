<?php

namespace Database\Seeders;

use App\Models\SuccessStory;
use Illuminate\Database\Seeder;

class SuccessStorySeeder extends Seeder
{
    public function run(): void
    {
        $stories = [
            [
                'title' => ['ar' => 'استرداد أرض تجارية بعد نزاع ملكية', 'en' => 'Recovering Commercial Land After an Ownership Dispute'],
                'excerpt' => ['ar' => 'نجح فريقنا في استرداد قطعة أرض تجارية لصالح موكلنا بعد نزاع ملكية استمر لسنوات.', 'en' => "Our team successfully recovered a commercial plot of land for our client after a years-long ownership dispute."],
                'body' => ['ar' => 'تولى المكتب الدفاع عن أحد عملائنا في نزاع معقد على ملكية قطعة أرض تجارية، حيث قام الفريق القانوني بجمع كافة المستندات التاريخية للملكية وتقديم مرافعة قوية أمام المحكمة الاقتصادية، مما أسفر عن صدور حكم نهائي لصالح موكلنا باسترداد كامل حقوقه.', 'en' => 'The firm defended a client in a complex ownership dispute over a commercial plot of land. The legal team gathered all historical ownership documents and presented a strong argument before the Economic Court, resulting in a final ruling fully restoring our client\'s rights.'],
                'category' => ['ar' => 'عقارات وأراضٍ', 'en' => 'Real Estate'],
                'story_date' => '2025-03-12',
            ],
            [
                'title' => ['ar' => 'تسوية نزاع تجاري بين شركاء دون تقاضٍ', 'en' => 'Settling a Partner Dispute Without Litigation'],
                'excerpt' => ['ar' => 'توصلنا إلى تسوية ودية بين شريكين في نزاع حول توزيع الأرباح، وفرنا بذلك وقتاً وتكاليف كبيرة على الطرفين.', 'en' => 'We reached an amicable settlement between two partners in a profit-distribution dispute, saving both sides significant time and cost.'],
                'body' => ['ar' => 'بدلاً من اللجوء إلى التقاضي، تولى فريق التحكيم لدينا قيادة جلسات تفاوض مكثفة بين الشريكين المتنازعين على توزيع الأرباح، وانتهى الأمر بتوقيع اتفاقية تسوية عادلة للطرفين خلال أقل من شهرين، مقارنة بالسنوات التي قد تستغرقها الدعوى القضائية.', 'en' => 'Rather than resorting to litigation, our arbitration team led intensive negotiation sessions between the disputing partners over profit distribution, resulting in a fair settlement agreement signed within less than two months — compared to the years a lawsuit might have taken.'],
                'category' => ['ar' => 'تحكيم', 'en' => 'Arbitration'],
                'story_date' => '2025-06-02',
            ],
            [
                'title' => ['ar' => 'الحكم برفض دعوى فصل تعسفي كيدية', 'en' => 'Dismissal of a Bad-Faith Wrongful Termination Claim'],
                'excerpt' => ['ar' => 'دافعنا عن شركة عميلة ضد دعوى فصل تعسفي كيدية، وانتهت القضية برفض الدعوى بالكامل.', 'en' => "We defended a client company against a bad-faith wrongful-termination claim, which ended in the case's full dismissal."],
                'body' => ['ar' => 'واجه أحد عملائنا من الشركات دعوى فصل تعسفي من موظف سابق، فتولى فريقنا القانوني إعداد ملف دفاع متكامل يوثق أسباب إنهاء الخدمة وفق نظام العمل، وانتهت الدعوى برفضها بالكامل لصالح الشركة.', 'en' => "One of our corporate clients faced a wrongful-termination claim from a former employee. Our legal team prepared a complete defense file documenting the grounds for termination in accordance with labor law, and the case ended with a full dismissal in the company's favor."],
                'category' => ['ar' => 'قانون العمل', 'en' => 'Labor Law'],
                'story_date' => '2024-11-20',
            ],
            [
                'title' => ['ar' => 'حضانة الأبناء لصالح الأم بعد نزاع أسري طويل', 'en' => "Securing Child Custody for a Mother After a Long Family Dispute"],
                'excerpt' => ['ar' => 'ساعدنا إحدى الأمهات في الحصول على حضانة أبنائها بعد نزاع أسري استمر لأكثر من عام.', 'en' => 'We helped a mother secure custody of her children after a family dispute that lasted over a year.'],
                'body' => ['ar' => 'تابعت المحامية المسؤولة القضية منذ بدايتها، وقدمت كافة المستندات والشهادات اللازمة لإثبات أحقية الأم بالحضانة، مع مراعاة تامة لمصلحة الأطفال طوال مراحل التقاضي، وانتهى الأمر بحكم نهائي لصالح موكلتنا.', 'en' => "The lawyer in charge followed the case from the outset, submitting all necessary documents and testimonies to establish the mother's right to custody, with full regard for the children's best interests throughout the litigation. The case concluded with a final ruling in our client's favor."],
                'category' => ['ar' => 'أحوال شخصية', 'en' => 'Personal Status'],
                'story_date' => '2024-08-15',
            ],
        ];

        foreach ($stories as $i => $story) {
            $successStory = SuccessStory::firstOrCreate(
                ['title->ar' => $story['title']['ar']],
                [...$story, 'sort_order' => $i, 'is_active' => true]
            );

            if (! $successStory->hasMedia('image') && file_exists(public_path('assets/success-stories.avif'))) {
                $successStory->addMedia(public_path('assets/success-stories.avif'))
                    ->preservingOriginal()
                    ->toMediaCollection('image');
            }
        }
    }
}
