<?php

namespace Database\Seeders;

use App\Models\Branch;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        $branch = Branch::where('is_main', true)->first();

        $admin = User::firstOrCreate(
            ['email' => 'ahmedramadan1272022@gmail.com'],
            [
                'branch_id' => $branch?->id,
                'name' => ['ar' => 'المدير العام', 'en' => 'Admin'],
                'phone' => '01012345678',
                'password' => Hash::make('password'),
                'is_active' => true,
            ]
        );

        if (! $admin->hasRole('Admin')) {
            $admin->assignRole('Admin');
        }
    }
}
