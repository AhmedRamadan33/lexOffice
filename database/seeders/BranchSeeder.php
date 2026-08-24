<?php

namespace Database\Seeders;

use App\Models\Branch;
use Illuminate\Database\Seeder;

class BranchSeeder extends Seeder
{
    public function run(): void
    {
        Branch::firstOrCreate(
            ['name->ar' => 'المكتب الرئيسي'],
            [
                'name' => ['ar' => 'المكتب الرئيسي', 'en' => 'Head Office'],
                'phone' => '0223456789',
                'address' => [
                    'ar' => '25 شارع قصر النيل، وسط البلد، القاهرة',
                    'en' => '25 Qasr El-Nil St., Downtown, Cairo',
                ],
                'is_main' => true,
                'is_active' => true,
            ]
        );
    }
}
