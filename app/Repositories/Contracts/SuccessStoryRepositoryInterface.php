<?php

namespace App\Repositories\Contracts;

use Illuminate\Support\Collection;

interface SuccessStoryRepositoryInterface extends BaseRepositoryInterface
{
    public function listActive(): Collection;
}
