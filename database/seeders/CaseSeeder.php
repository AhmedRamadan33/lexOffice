<?php

namespace Database\Seeders;

use App\Models\CaseModel;
use Illuminate\Database\Seeder;

class CaseSeeder extends Seeder
{
    public function run(): void
    {
        CaseModel::factory()
            ->count(10)
            ->create()
            ->each(fn (CaseModel $case) => $case->clients()->syncWithoutDetaching([$case->client_id]));
    }
}
