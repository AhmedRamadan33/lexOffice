<?php

namespace Database\Seeders;

use App\Models\Branch;
use App\Models\User;
use Illuminate\Database\Seeder;

class DemoUserSeeder extends Seeder
{
    public function run(): void
    {
        $branchId = Branch::where('is_main', true)->value('id');

        $users = [
            ['name' => ['ar' => 'محمد الجندي', 'en' => 'Mohamed El-Guindy'], 'email' => 'lawyer1@lexoffice.test', 'role' => 'Lawyer'],
            ['name' => ['ar' => 'سارة عبد الله', 'en' => 'Sara Abdullah'], 'email' => 'lawyer2@lexoffice.test', 'role' => 'Lawyer'],
            ['name' => ['ar' => 'أحمد فتحي', 'en' => 'Ahmed Fathy'], 'email' => 'secretary@lexoffice.test', 'role' => 'Secretary'],
            ['name' => ['ar' => 'منى إبراهيم', 'en' => 'Mona Ibrahim'], 'email' => 'accountant@lexoffice.test', 'role' => 'Accountant'],
        ];

        foreach ($users as $data) {
            $user = User::factory()->create([
                'branch_id' => $branchId,
                'name' => $data['name'],
                'email' => $data['email'],
            ]);

            $user->assignRole($data['role']);
        }
    }
}
