<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Auth;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            RolePermissionSeeder::class,
            BranchSeeder::class,
            AdminUserSeeder::class,
            DemoUserSeeder::class,
        ]);

    
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
            SiteSettingSeeder::class,
            PracticeAreaSeeder::class,
            TestimonialSeeder::class,
            SuccessStorySeeder::class,
        ]);

        Auth::logout();
    }
}
