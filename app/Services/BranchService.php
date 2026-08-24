<?php

namespace App\Services;

use App\Models\Branch;
use App\Repositories\Contracts\BranchRepositoryInterface;
use Illuminate\Pagination\LengthAwarePaginator;

class BranchService
{
    public function __construct(protected BranchRepositoryInterface $branches)
    {
    }

    public function paginate(array $filters): LengthAwarePaginator
    {
        return $this->branches->paginate($filters);
    }

    public function create(array $data): Branch
    {
        return $this->branches->create($data);
    }

    public function update(Branch $branch, array $data): Branch
    {
        return $this->branches->update($branch, $data);
    }

    public function delete(Branch $branch): bool
    {
        if ($branch->users()->exists()) {
            throw new \DomainException(__('app.messages.no_results'));
        }

        return $this->branches->delete($branch);
    }
}
