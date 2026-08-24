<?php

namespace App\Repositories\Eloquent;

use App\Models\Expense;
use App\Repositories\Contracts\ExpenseRepositoryInterface;
use Illuminate\Pagination\LengthAwarePaginator;

class ExpenseRepository extends BaseRepository implements ExpenseRepositoryInterface
{
    public function __construct(Expense $model)
    {
        parent::__construct($model);
    }

    public function paginate(array $filters = [], int $perPage = 15): LengthAwarePaginator
    {
        return $this->query()
            ->when($filters['search'] ?? null, function ($q, $search) {
                $q->where(function ($q) use ($search) {
                    $q->where('category->ar', 'like', "%{$search}%")
                        ->orWhere('category->en', 'like', "%{$search}%")
                        ->orWhere('description->ar', 'like', "%{$search}%")
                        ->orWhere('description->en', 'like', "%{$search}%");
                });
            })
            ->when($filters['category'] ?? null, function ($q, $category) {
                $q->where(fn ($q) => $q->where('category->ar', $category)->orWhere('category->en', $category));
            })
            ->latest('expense_date')
            ->paginate($this->perPage($filters, $perPage))
            ->withQueryString();
    }
}
