<?php

namespace App\Services;

use App\Models\Court;
use App\Repositories\Contracts\CourtRepositoryInterface;
use Illuminate\Pagination\LengthAwarePaginator;

class CourtService
{
    public function __construct(protected CourtRepositoryInterface $courts)
    {
    }

    public function paginate(array $filters): LengthAwarePaginator
    {
        return $this->courts->paginate($filters);
    }

    public function create(array $data): Court
    {
        return $this->courts->create($data);
    }

    public function update(Court $court, array $data): Court
    {
        return $this->courts->update($court, $data);
    }

    public function delete(Court $court): bool
    {
        return $this->courts->delete($court);
    }
}
