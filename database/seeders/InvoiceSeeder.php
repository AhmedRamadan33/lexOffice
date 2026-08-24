<?php

namespace Database\Seeders;

use App\Models\Invoice;
use Illuminate\Database\Seeder;

class InvoiceSeeder extends Seeder
{
    public function run(): void
    {
        $descriptions = [
            ['ar' => 'أتعاب استشارة قانونية', 'en' => 'Legal consultation fees'],
            ['ar' => 'أتعاب تمثيل قضائي', 'en' => 'Court representation fees'],
            ['ar' => 'رسوم متابعة قضية', 'en' => 'Case follow-up fees'],
            ['ar' => 'أتعاب صياغة عقد', 'en' => 'Contract drafting fees'],
        ];

        Invoice::factory()->count(8)->create()->each(function (Invoice $invoice) use ($descriptions) {
            $itemsCount = fake()->numberBetween(1, 3);
            $subtotal = 0;

            for ($i = 0; $i < $itemsCount; $i++) {
                $amount = fake()->randomFloat(2, 200, 2000);
                $subtotal += $amount;

                $invoice->items()->create([
                    'description' => fake()->randomElement($descriptions),
                    'amount' => $amount,
                ]);
            }

            $tax = round($subtotal * fake()->randomElement([0, 0, 0.14]), 2);
            $discount = fake()->boolean(20) ? round($subtotal * 0.05, 2) : 0;
            $total = max($subtotal + $tax - $discount, 0);

            $invoice->update([
                'subtotal' => $subtotal,
                'tax' => $tax,
                'discount' => $discount,
                'total' => $total,
            ]);

            $paymentState = fake()->randomElement(['unpaid', 'unpaid', 'partial', 'paid']);

            if ($paymentState === 'paid') {
                $invoice->payments()->create([
                    'amount' => $total,
                    'paid_at' => fake()->dateTimeBetween($invoice->created_at, 'now'),
                    'method' => fake()->randomElement(['cash', 'bank_transfer', 'cheque', 'card']),
                    'created_by' => $invoice->created_by,
                ]);
            } elseif ($paymentState === 'partial') {
                $invoice->payments()->create([
                    'amount' => round($total * fake()->randomFloat(2, 0.2, 0.7), 2),
                    'paid_at' => fake()->dateTimeBetween($invoice->created_at, 'now'),
                    'method' => fake()->randomElement(['cash', 'bank_transfer', 'cheque', 'card']),
                    'created_by' => $invoice->created_by,
                ]);
            }
        });
    }
}
