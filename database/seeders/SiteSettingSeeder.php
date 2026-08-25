<?php

namespace Database\Seeders;

use App\Models\SiteSetting;
use Illuminate\Database\Seeder;

class SiteSettingSeeder extends Seeder
{
    public function run(): void
    {
        $setting = SiteSetting::current();

        $setting->update([
            'hero_title' => ['ar' => 'قضاياك القانونية.. التزامنا واحترافيتنا', 'en' => 'Your Legal Matters, Our Commitment & Expertise'],
            'hero_subtitle' => [
                'ar' => 'نقدم حلولاً قانونية متكاملة للأفراد والشركات بخبرة عالية الجودة وبراعة في إدارة القضايا واحترام كامل لحقوق عملائنا.',
                'en' => 'We provide comprehensive legal solutions for individuals and businesses, backed by high-quality expertise and full respect for our clients\' rights.',
            ],
            'hero_cta_primary_text' => ['ar' => 'احجز استشارة الآن', 'en' => 'Book a Consultation'],
            'hero_cta_primary_url' => route('public.contact'),
            'hero_cta_secondary_text' => ['ar' => 'تعرف على خدماتنا', 'en' => 'Explore Our Services'],
            'hero_cta_secondary_url' => route('public.services'),

            'stat1_value' => '6+',
            'stat1_label' => ['ar' => 'فروع داخل الدولة', 'en' => 'Branches Nationwide'],
            'stat2_value' => '300+',
            'stat2_label' => ['ar' => 'عميل وثقوا بنا', 'en' => 'Clients Served'],
            'stat3_value' => '500+',
            'stat3_label' => ['ar' => 'قضية ناجحة', 'en' => 'Cases Won'],
            'stat4_value' => '15+',
            'stat4_label' => ['ar' => 'سنوات من الخبرة', 'en' => 'Years of Experience'],

            'about_title' => ['ar' => 'عن مكتب LexOffice', 'en' => 'About LexOffice'],
            'about_body' => [
                'ar' => 'منذ تأسيسنا، ونحن ملتزمون بتقديم خدمات قانونية عالية الجودة تلبي احتياجات الأفراد والشركات. يضم فريقنا نخبة من المحامين والمستشارين القانونيين ذوي الخبرة الواسعة في مختلف المجالات القانونية، ونحرص دائماً على حماية حقوق عملائنا وتحقيق أفضل النتائج الممكنة.',
                'en' => 'Since our founding, we have been committed to providing high-quality legal services that meet the needs of individuals and companies. Our team includes a select group of lawyers and legal consultants with extensive experience across various legal fields, always dedicated to protecting our clients\' rights and achieving the best possible outcomes.',
            ],
            'vision_text' => [
                'ar' => 'أن نكون المكتب القانوني الرائد والأكثر ثقة في المنطقة، من خلال تقديم حلول قانونية مبتكرة تليق بتطلعات عملائنا.',
                'en' => 'To be the leading and most trusted law firm in the region by delivering innovative legal solutions worthy of our clients\' aspirations.',
            ],
            'mission_text' => [
                'ar' => 'تقديم خدمات قانونية متكاملة تجمع بين الاحترافية والنزاهة والسرية التامة لحماية مصالح عملائنا في كل خطوة.',
                'en' => 'Delivering comprehensive legal services that combine professionalism, integrity, and complete confidentiality to protect our clients\' interests every step of the way.',
            ],
            'values_text' => [
                'ar' => 'الاستقامة، الشفافية، الالتزام بالمواعيد، والسعي الدائم لتحقيق أفضل مصلحة لعملائنا.',
                'en' => 'Integrity, transparency, punctuality, and a constant pursuit of our clients\' best interests.',
            ],
            'experience_text' => [
                'ar' => 'أكثر من 15 عاماً من الخبرة في التقاضي والاستشارات القانونية لصالح الأفراد والشركات على حد سواء.',
                'en' => 'Over 15 years of experience in litigation and legal consultation for both individuals and businesses.',
            ],

            'contact_phone_primary' => '+966 11 234 5678',
            'contact_phone_secondary' => '+966 50 123 4567',
            'contact_email' => 'info@lexoffice.example',
            'contact_address' => ['ar' => 'المملكة العربية السعودية، الرياض، طريق الملك فهد', 'en' => 'King Fahd Road, Riyadh, Saudi Arabia'],
            'contact_working_hours' => ['ar' => 'الأحد - الخميس: 9 صباحاً - 5 مساءً', 'en' => 'Sunday - Thursday: 9 AM - 5 PM'],
            'contact_map_embed_url' => null,
            'facebook_url' => null,
            'twitter_url' => null,
            'linkedin_url' => null,
            'instagram_url' => null,
            'whatsapp_url' => null,

            'footer_about_text' => [
                'ar' => 'مكتب محاماة واستشارات قانونية متكامل، نضع خبرتنا في خدمة عملائنا لتحقيق العدالة وحماية حقوقهم.',
                'en' => 'A full-service law and legal consultation firm, putting our expertise at our clients\' service to achieve justice and protect their rights.',
            ],
            'footer_copyright' => ['ar' => 'جميع الحقوق محفوظة © '.date('Y').' مكتب LexOffice', 'en' => 'All rights reserved © '.date('Y').' LexOffice'],
        ]);

        if (! $setting->hasMedia('hero_image') && file_exists(public_path('assets/hero_image.webp'))) {
            $setting->addMedia(public_path('assets/hero_image.webp'))
                ->preservingOriginal()
                ->toMediaCollection('hero_image');
        }

        if (! $setting->hasMedia('about_image') && file_exists(public_path('assets/about_image.png'))) {
            $setting->addMedia(public_path('assets/about_image.png'))
                ->preservingOriginal()
                ->toMediaCollection('about_image');
        }
    }
}
