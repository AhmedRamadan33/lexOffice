<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Payment>
 */
class PaymentFactory extends Factory
{
    public function definition(): array
    {
        return [
            'amount' => fake()->randomFloat(2, 50, 500),
            'paid_at' => fake()->dateTimeBetween('-2 months', 'now'),
            'method' => fake()->randomElement(['cash', 'bank_transfer', 'cheque', 'card', 'other']),
            'notes' => fake()->optional(0.2)->sentence(),
            'created_by' => fn () => User::query()->inRandomOrder()->value('id'),
        ];
    }
}
