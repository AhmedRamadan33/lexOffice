<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Auth;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            RolePermissionSeeder::class,
            BranchSeeder::class,
            AdminUserSeeder::class,
            DemoUserSeeder::class,
        ]);

        // Log in as the Admin so every record created below — and the activity log
        // entries generated for them — is attributed to a real user and branch,
        // instead of showing up as anonymous/system-generated seed data.
        $admin = User::where('email', 'ahmedramadan1272022@gmail.com')->first();
        Auth::login($admin);

        $this->call([
            CourtSeeder::class,
            CaseTypeSeeder::class,
            ClientSeeder::class,
            CaseSeeder::class,
            CaseSessionSeeder::class,
            InvoiceSeeder::class,
            ExpenseSeeder::class,
            TaskSeeder::class,
        ]);

        Auth::logout();
    }
}
