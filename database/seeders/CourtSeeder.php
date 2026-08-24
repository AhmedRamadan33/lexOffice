<?php

namespace Database\Seeders;

use App\Models\Court;
use Illuminate\Database\Seeder;

class CourtSeeder extends Seeder
{
    public function run(): void
    {
        $courts = [
            ['ar' => 'محكمة الأسرة', 'en' => 'Family Court'],
            ['ar' => 'محكمة المواد الجزئية', 'en' => 'Summary Court'],
            ['ar' => 'المحكمة الابتدائية', 'en' => 'Court of First Instance'],
            ['ar' => 'محكمة الاستئناف', 'en' => 'Court of Appeal'],
            ['ar' => 'محكمة النقض', 'en' => 'Court of Cassation'],
            ['ar' => 'المحكمة الاقتصادية', 'en' => 'Economic Court'],
            ['ar' => 'محكمة مجلس الدولة', 'en' => 'State Council Court'],
            ['ar' => 'محكمة العمال', 'en' => 'Labor Court'],
        ];

        foreach ($courts as $name) {
            Court::firstOrCreate(['name->ar' => $name['ar']], ['name' => $name]);
        }
    }
}
