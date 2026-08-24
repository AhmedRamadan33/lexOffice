<?php

namespace Database\Seeders;

use App\Models\CaseType;
use Illuminate\Database\Seeder;

class CaseTypeSeeder extends Seeder
{
    public function run(): void
    {
        $types = [
            ['ar' => 'مدني', 'en' => 'Civil'],
            ['ar' => 'جنائي', 'en' => 'Criminal'],
            ['ar' => 'أحوال شخصية', 'en' => 'Personal Status'],
            ['ar' => 'تجاري', 'en' => 'Commercial'],
            ['ar' => 'عمالي', 'en' => 'Labor'],
            ['ar' => 'إداري', 'en' => 'Administrative'],
            ['ar' => 'أسرة', 'en' => 'Family'],
        ];

        foreach ($types as $name) {
            CaseType::firstOrCreate(['name->ar' => $name['ar']], ['name' => $name]);
        }
    }
}
