<?php

namespace App\Repositories\Eloquent;

use App\Models\CaseType;
use App\Repositories\Contracts\CaseTypeRepositoryInterface;
use Illuminate\Pagination\LengthAwarePaginator;

class CaseTypeRepository extends BaseRepository implements CaseTypeRepositoryInterface
{
    public function __construct(CaseType $model)
    {
        parent::__construct($model);
    }

    public function paginate(array $filters = [], int $perPage = 15): LengthAwarePaginator
    {
        return $this->query()
            ->when($filters['search'] ?? null, function ($q, $search) {
                $q->where(fn ($q) => $q->where('name->ar', 'like', "%{$search}%")->orWhere('name->en', 'like', "%{$search}%"));
            })
            ->when(array_key_exists('is_active', $filters) && $filters['is_active'] !== null, fn ($q) => $q->where('is_active', $filters['is_active']))
            ->orderBy('name->ar')
            ->paginate($this->perPage($filters, $perPage))
            ->withQueryString();
    }
}
