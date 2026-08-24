<?php

namespace App\Services;

use App\Models\Expense;
use App\Repositories\Contracts\ExpenseRepositoryInterface;
use Illuminate\Pagination\LengthAwarePaginator;

class ExpenseService
{
    public function __construct(protected ExpenseRepositoryInterface $expenses)
    {
    }

    public function paginate(array $filters): LengthAwarePaginator
    {
        return $this->expenses->paginate($filters);
    }

    public function create(array $data, int $userId): Expense
    {
        $data['created_by'] = $userId;

        return $this->expenses->create($data);
    }

    public function update(Expense $expense, array $data): Expense
    {
        return $this->expenses->update($expense, $data);
    }

    public function delete(Expense $expense): bool
    {
        return $this->expenses->delete($expense);
    }
}
