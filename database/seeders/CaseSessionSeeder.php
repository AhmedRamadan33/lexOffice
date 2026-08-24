<?php

namespace Database\Seeders;

use App\Models\CaseModel;
use App\Models\CaseSession;
use Illuminate\Database\Seeder;

class CaseSessionSeeder extends Seeder
{
    public function run(): void
    {
        CaseModel::query()->inRandomOrder()->limit(8)->get()->each(function (CaseModel $case) {
            CaseSession::factory()
                ->count(fake()->numberBetween(1, 2))
                ->create(['case_id' => $case->id]);
        });
    }
}
