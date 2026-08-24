<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    private const NAMES = [
        ['ar' => 'محمد إبراهيم عطية', 'en' => 'Mohamed Ibrahim Attia'],
        ['ar' => 'نهى صلاح الدين', 'en' => 'Noha Salah El-Din'],
        ['ar' => 'خالد أمين رزق', 'en' => 'Khaled Amin Rizk'],
        ['ar' => 'أميرة وليد شحاتة', 'en' => 'Amira Waleed Shehata'],
        ['ar' => 'يوسف عماد فهمي', 'en' => 'Youssef Emad Fahmy'],
        ['ar' => 'مريم حاتم البدري', 'en' => 'Mariam Hatem El-Badry'],
    ];

    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->unique()->randomElement(self::NAMES),
            'email' => fake()->unique()->safeEmail(),
            'phone' => '01'.fake()->randomElement([0, 1, 2, 5]).fake()->numerify('########'),
            'is_active' => true,
            'email_verified_at' => now(),
            'password' => static::$password ??= Hash::make('password'),
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
