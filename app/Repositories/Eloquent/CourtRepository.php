<?php

namespace App\Repositories\Eloquent;

use App\Models\Court;
use App\Repositories\Contracts\CourtRepositoryInterface;
use Illuminate\Pagination\LengthAwarePaginator;

class CourtRepository extends BaseRepository implements CourtRepositoryInterface
{
    public function __construct(Court $model)
    {
        parent::__construct($model);
    }

    public function paginate(array $filters = [], int $perPage = 15): LengthAwarePaginator
    {
        return $this->query()
            ->when($filters['search'] ?? null, function ($q, $search) {
                $q->where(function ($q) use ($search) {
                    $q->where('name->ar', 'like', "%{$search}%")
                        ->orWhere('name->en', 'like', "%{$search}%")
                        ->orWhere('type->ar', 'like', "%{$search}%")
                        ->orWhere('type->en', 'like', "%{$search}%");
                });
            })
            ->when(array_key_exists('is_active', $filters) && $filters['is_active'] !== null, fn ($q) => $q->where('is_active', $filters['is_active']))
            ->orderBy('name->ar')
            ->paginate($this->perPage($filters, $perPage))
            ->withQueryString();
    }
}
