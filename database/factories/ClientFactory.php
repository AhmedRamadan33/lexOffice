<?php

namespace Database\Factories;

use App\Models\Branch;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Client>
 */
class ClientFactory extends Factory
{
    private const INDIVIDUALS = [
        ['ar' => 'أحمد محمود السيد', 'en' => 'Ahmed Mahmoud El-Sayed'],
        ['ar' => 'منى عبد الرحمن حسن', 'en' => 'Mona Abdel Rahman Hassan'],
        ['ar' => 'كريم يوسف عبد العزيز', 'en' => 'Kareem Youssef Abdel Aziz'],
        ['ar' => 'هبة الله فاروق', 'en' => 'Hebatullah Farouk'],
        ['ar' => 'عمرو خالد إبراهيم', 'en' => 'Amr Khaled Ibrahim'],
        ['ar' => 'ياسمين طارق الشريف', 'en' => 'Yasmin Tarek El-Sherif'],
        ['ar' => 'محمود عادل رشدي', 'en' => 'Mahmoud Adel Roshdy'],
        ['ar' => 'نور الهدى سامي', 'en' => 'Nour El-Huda Sami'],
        ['ar' => 'طارق سعيد المصري', 'en' => 'Tarek Saeed El-Masry'],
        ['ar' => 'رانيا حمدي عثمان', 'en' => 'Rania Hamdy Othman'],
        ['ar' => 'وائل نبيل غنيم', 'en' => 'Wael Nabil Ghoneim'],
        ['ar' => 'دينا أشرف كامل', 'en' => 'Dina Ashraf Kamel'],
    ];

    private const COMPANIES = [
        ['ar' => 'شركة النيل الحديثة للمقاولات', 'en' => 'Modern Nile Contracting Co.'],
        ['ar' => 'مجموعة الدلتا التجارية', 'en' => 'Delta Trading Group'],
        ['ar' => 'مصنع الأهرام للصناعات الغذائية', 'en' => 'Al-Ahram Food Industries'],
        ['ar' => 'شركة القاهرة للاستيراد والتصدير', 'en' => 'Cairo Import & Export Co.'],
        ['ar' => 'مؤسسة الفجر العقارية', 'en' => 'Al-Fajr Real Estate Est.'],
        ['ar' => 'شركة السلام للنقل والشحن', 'en' => 'Al-Salam Shipping & Logistics'],
        ['ar' => 'مجموعة أسوان للصناعات الهندسية', 'en' => 'Aswan Engineering Industries'],
        ['ar' => 'شركة الواحة للاستثمار', 'en' => 'Al-Waha Investment Co.'],
    ];

    private const ADDRESSES = [
        ['ar' => '12 شارع الجمهورية، مصر الجديدة، القاهرة', 'en' => '12 El-Gomhoria St., Heliopolis, Cairo'],
        ['ar' => '34 شارع الهرم، الجيزة', 'en' => '34 Haram St., Giza'],
        ['ar' => '7 شارع النصر، مدينة نصر، القاهرة', 'en' => '7 El-Nasr St., Nasr City, Cairo'],
        ['ar' => '21 كورنيش النيل، المعادي، القاهرة', 'en' => '21 Nile Corniche, Maadi, Cairo'],
        ['ar' => '15 شارع فؤاد، الإسكندرية', 'en' => '15 Fouad St., Alexandria'],
        ['ar' => '9 شارع الجيش، طنطا', 'en' => '9 El-Geish St., Tanta'],
        ['ar' => '3 شارع الثورة، المنصورة', 'en' => '3 El-Thawra St., Mansoura'],
        ['ar' => '18 شارع سوريا، المهندسين، الجيزة', 'en' => '18 Syria St., Mohandessin, Giza'],
    ];

    private const NOTES = [
        ['ar' => 'عميل منتظم في السداد.', 'en' => 'Client with a consistent payment record.'],
        ['ar' => 'يفضل التواصل عبر البريد الإلكتروني.', 'en' => 'Prefers to be contacted by email.'],
        ['ar' => 'تم التعرف عليه من خلال عميل آخر.', 'en' => 'Referred by an existing client.'],
        ['ar' => 'يطلب تحديثات دورية عن قضاياه.', 'en' => 'Requests periodic updates on his cases.'],
    ];

    public function definition(): array
    {
        $type = fake()->randomElement(['individual', 'company']);
        $name = fake()->unique()->randomElement($type === 'company' ? self::COMPANIES : self::INDIVIDUALS);
        $address = fake()->randomElement(self::ADDRESSES);

        return [
            'branch_id' => fn () => Branch::query()->value('id'),
            'name' => $name,
            'type' => $type,
            'phone' => '01'.fake()->randomElement([0, 1, 2, 5]).fake()->numerify('########'),
            'email' => fake()->optional(0.6)->safeEmail(),
            'national_id' => $type === 'individual' ? fake()->optional(0.7)->numerify('#############') : null,
            'address' => $address,
            'notes' => fake()->optional(0.4)->randomElement(self::NOTES) ?? ['ar' => null, 'en' => null],
        ];
    }
}
