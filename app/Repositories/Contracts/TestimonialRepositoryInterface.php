<?php

namespace App\Repositories\Contracts;

use Illuminate\Support\Collection;

interface TestimonialRepositoryInterface extends BaseRepositoryInterface
{
    public function listActive(): Collection;
}
