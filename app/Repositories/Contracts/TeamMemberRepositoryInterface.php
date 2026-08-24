<?php

namespace App\Repositories\Contracts;

use Illuminate\Support\Collection;

interface TeamMemberRepositoryInterface extends BaseRepositoryInterface
{
    public function listActive(): Collection;
}
