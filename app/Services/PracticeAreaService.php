<?php

namespace App\Services;

use App\Models\PracticeArea;
use App\Repositories\Contracts\PracticeAreaRepositoryInterface;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class PracticeAreaService
{
    public function __construct(protected PracticeAreaRepositoryInterface $practiceAreas)
    {
    }

    public function paginate(array $filters): LengthAwarePaginator
    {
        return $this->practiceAreas->paginate($filters);
    }

    public function listActive(): Collection
    {
        return $this->practiceAreas->listActive();
    }

    public function create(array $data): PracticeArea
    {
        return $this->practiceAreas->create($data);
    }

    public function update(PracticeArea $practiceArea, array $data): PracticeArea
    {
        return $this->practiceAreas->update($practiceArea, $data);
    }

    public function delete(PracticeArea $practiceArea): bool
    {
        return $this->practiceAreas->delete($practiceArea);
    }
}
