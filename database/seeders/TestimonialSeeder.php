<?php

namespace Database\Seeders;

use App\Models\Testimonial;
use Illuminate\Database\Seeder;

class TestimonialSeeder extends Seeder
{
    public function run(): void
    {
        $testimonials = [
            [
                'client_name' => ['ar' => 'عبدالله المطيري', 'en' => 'Abdullah Al-Mutairi'],
                'quote' => ['ar' => 'تعاملت مع المكتب في قضية تجارية معقدة، وكان الفريق على درجة عالية من الاحترافية والمتابعة المستمرة حتى صدور الحكم لصالحنا.', 'en' => 'I worked with the firm on a complex commercial case, and the team was highly professional with continuous follow-up until the ruling came in our favor.'],
                'rating' => 5,
            ],
            [
                'client_name' => ['ar' => 'ريم القحطاني', 'en' => 'Reem Al-Qahtani'],
                'quote' => ['ar' => 'شكراً لمكتب LexOffice على الدعم القانوني الكامل في قضية الحضانة، تعاملهم كان إنسانياً واحترافياً في نفس الوقت.', 'en' => 'Thank you to LexOffice for their full legal support in my custody case — their approach was both human and professional.'],
                'rating' => 5,
            ],
            [
                'client_name' => ['ar' => 'شركة النخبة للمقاولات', 'en' => 'Al-Nokhba Contracting Co.'],
                'quote' => ['ar' => 'نتعامل مع المكتب منذ سنوات في كافة استشاراتنا القانونية، ونثق تماماً في دقتهم والتزامهم بالمواعيد.', 'en' => "We've worked with the firm for years on all our legal consultations, and we fully trust their accuracy and punctuality."],
                'rating' => 5,
            ],
            [
                'client_name' => ['ar' => 'فيصل الدوسري', 'en' => 'Faisal Al-Dosari'],
                'quote' => ['ar' => 'فريق متمكن وسريع الاستجابة، ساعدني المكتب في تسوية نزاع عقاري كان معلقاً منذ فترة طويلة.', 'en' => 'A capable and responsive team — the firm helped me settle a real-estate dispute that had been pending for a long time.'],
                'rating' => 4,
            ],
            [
                'client_name' => ['ar' => 'هند العنزي', 'en' => 'Hind Al-Anazi'],
                'quote' => ['ar' => 'استشارة قانونية واضحة ومباشرة، وأسعار عادلة مقارنة بجودة الخدمة المقدمة.', 'en' => 'Clear and straightforward legal consultation, with fair pricing relative to the quality of service.'],
                'rating' => 5,
            ],
        ];

        foreach ($testimonials as $i => $testimonial) {
            Testimonial::firstOrCreate(
                ['client_name->ar' => $testimonial['client_name']['ar']],
                [...$testimonial, 'sort_order' => $i, 'is_active' => true]
            );
        }
    }
}
