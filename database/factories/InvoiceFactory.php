<?php

namespace Database\Factories;

use App\Models\Branch;
use App\Models\Client;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Invoice>
 */
class InvoiceFactory extends Factory
{
    private const NOTES = [
        ['ar' => 'يرجى السداد خلال المدة المحددة.', 'en' => 'Please settle payment within the specified period.'],
        ['ar' => 'الفاتورة شاملة أتعاب المتابعة القضائية.', 'en' => 'Invoice includes court follow-up fees.'],
        ['ar' => 'تم الاتفاق على السداد على دفعتين.', 'en' => 'Payment was agreed to be settled in two installments.'],
    ];

    public function definition(): array
    {
        return [
            'branch_id' => fn () => Branch::query()->value('id'),
            'invoice_number' => 'INV-'.now()->year.'-'.fake()->unique()->numerify('####'),
            'client_id' => fn () => Client::query()->inRandomOrder()->value('id'),
            'case_id' => null,
            'subtotal' => 0,
            'tax' => 0,
            'discount' => 0,
            'total' => 0,
            'status' => 'unpaid',
            'due_date' => fake()->dateTimeBetween('now', '+2 months'),
            'notes' => fake()->optional(0.4)->randomElement(self::NOTES) ?? ['ar' => null, 'en' => null],
            'created_by' => fn () => auth()->id(),
        ];
    }
}
