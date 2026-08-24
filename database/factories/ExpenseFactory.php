<?php

namespace Database\Factories;

use App\Models\Branch;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Expense>
 */
class ExpenseFactory extends Factory
{
    private const ITEMS = [
        [
            'category' => ['ar' => 'إيجار المكتب', 'en' => 'Office Rent'],
            'description' => ['ar' => 'إيجار المكتب الرئيسي عن الشهر الحالي.', 'en' => 'Head office rent for the current month.'],
        ],
        [
            'category' => ['ar' => 'فواتير كهرباء ومياه', 'en' => 'Utilities'],
            'description' => ['ar' => 'سداد فاتورة الكهرباء والمياه الشهرية.', 'en' => 'Payment of the monthly electricity and water bill.'],
        ],
        [
            'category' => ['ar' => 'قرطاسية', 'en' => 'Stationery'],
            'description' => ['ar' => 'شراء أدوات مكتبية وأوراق طباعة.', 'en' => 'Purchase of office supplies and printing paper.'],
        ],
        [
            'category' => ['ar' => 'رسوم قضائية', 'en' => 'Court Fees'],
            'description' => ['ar' => 'سداد رسوم قيد دعوى قضائية.', 'en' => 'Payment of case filing fees.'],
        ],
        [
            'category' => ['ar' => 'صيانة', 'en' => 'Maintenance'],
            'description' => ['ar' => 'صيانة أجهزة الحاسب الآلي بالمكتب.', 'en' => 'Maintenance of the office computers.'],
        ],
        [
            'category' => ['ar' => 'مواصلات', 'en' => 'Transportation'],
            'description' => ['ar' => 'مصاريف انتقال لحضور جلسة بمحكمة أخرى.', 'en' => 'Transportation costs to attend a hearing at another court.'],
        ],
        [
            'category' => ['ar' => 'رواتب موظفين', 'en' => 'Staff Salaries'],
            'description' => ['ar' => 'صرف راتب أحد الموظفين الإداريين.', 'en' => 'Salary payment for an administrative staff member.'],
        ],
        [
            'category' => ['ar' => 'رسوم توثيق', 'en' => 'Notarization Fees'],
            'description' => ['ar' => 'رسوم توثيق توكيل رسمي بالشهر العقاري.', 'en' => 'Notarization fees for an official power of attorney.'],
        ],
    ];

    public function definition(): array
    {
        $item = fake()->randomElement(self::ITEMS);

        return [
            'branch_id' => fn () => Branch::query()->value('id'),
            'category' => $item['category'],
            'amount' => fake()->randomFloat(2, 100, 5000),
            'expense_date' => fake()->dateTimeBetween('-6 months', 'now'),
            'description' => $item['description'],
            'created_by' => fn () => auth()->id(),
        ];
    }
}
