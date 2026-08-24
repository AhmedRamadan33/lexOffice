<?php

namespace App\Repositories\Contracts;

use Illuminate\Support\Collection;

interface PracticeAreaRepositoryInterface extends BaseRepositoryInterface
{
    public function listActive(): Collection;
}
