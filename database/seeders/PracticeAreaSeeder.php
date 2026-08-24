<?php

namespace Database\Seeders;

use App\Models\PracticeArea;
use Illuminate\Database\Seeder;

class PracticeAreaSeeder extends Seeder
{
    public function run(): void
    {
        $areas = [
            [
                'icon' => 'bi-briefcase-fill',
                'title' => ['ar' => 'القانون التجاري', 'en' => 'Commercial Law'],
                'description' => ['ar' => 'تأسيس الشركات، العقود التجارية، النزاعات التجارية والاستحواذ.', 'en' => 'Company formation, commercial contracts, disputes, and acquisitions.'],
            ],
            [
                'icon' => 'bi-people-fill',
                'title' => ['ar' => 'قانون الأسرة', 'en' => 'Family Law'],
                'description' => ['ar' => 'الطلاق، الحضانة، النفقة، والميراث.', 'en' => 'Divorce, custody, alimony, and inheritance matters.'],
            ],
            [
                'icon' => 'bi-shield-fill-exclamation',
                'title' => ['ar' => 'القانون الجنائي', 'en' => 'Criminal Law'],
                'description' => ['ar' => 'الدفاع في القضايا الجنائية واستئناف الأحكام.', 'en' => 'Criminal defense representation and sentence appeals.'],
            ],
            [
                'icon' => 'bi-building',
                'title' => ['ar' => 'العقارات والأراضي', 'en' => 'Real Estate & Land'],
                'description' => ['ar' => 'ملكية العقارات، عقود الإيجار، والنزاعات العقارية.', 'en' => 'Property ownership, lease contracts, and real-estate disputes.'],
            ],
            [
                'icon' => 'bi-person-workspace',
                'title' => ['ar' => 'قانون العمل', 'en' => 'Labor Law'],
                'description' => ['ar' => 'عقود العمل، الفصل التعسفي، والتحكيم العمالي.', 'en' => 'Employment contracts, wrongful termination, and labor arbitration.'],
            ],
            [
                'icon' => 'bi-bank',
                'title' => ['ar' => 'القانون الإداري', 'en' => 'Administrative Law'],
                'description' => ['ar' => 'الطعن في القرارات الإدارية والتقاضي أمام مجلس الدولة.', 'en' => 'Challenging administrative decisions and State Council litigation.'],
            ],
            [
                'icon' => 'bi-diagram-3-fill',
                'title' => ['ar' => 'التحكيم وتسوية المنازعات', 'en' => 'Arbitration & Dispute Resolution'],
                'description' => ['ar' => 'التحكيم التجاري وتسوية المنازعات الودية.', 'en' => 'Commercial arbitration and amicable dispute settlement.'],
            ],
            [
                'icon' => 'bi-file-earmark-text-fill',
                'title' => ['ar' => 'الاستشارات القانونية', 'en' => 'Legal Consultation'],
                'description' => ['ar' => 'استشارات قانونية شاملة للأفراد والشركات في مختلف المجالات.', 'en' => 'Comprehensive legal consultations for individuals and businesses.'],
            ],
        ];

        foreach ($areas as $i => $area) {
            PracticeArea::firstOrCreate(
                ['title->ar' => $area['title']['ar']],
                [...$area, 'sort_order' => $i, 'is_active' => true]
            );
        }
    }
}
