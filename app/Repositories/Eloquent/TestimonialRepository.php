<?php

namespace App\Repositories\Eloquent;

use App\Models\Testimonial;
use App\Repositories\Contracts\TestimonialRepositoryInterface;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class TestimonialRepository extends BaseRepository implements TestimonialRepositoryInterface
{
    public function __construct(Testimonial $model)
    {
        parent::__construct($model);
    }

    public function paginate(array $filters = [], int $perPage = 15): LengthAwarePaginator
    {
        return $this->query()
            ->when($filters['search'] ?? null, function ($q, $search) {
                $q->where(function ($q) use ($search) {
                    $q->where('client_name->ar', 'like', "%{$search}%")
                        ->orWhere('client_name->en', 'like', "%{$search}%");
                });
            })
            ->when(array_key_exists('is_active', $filters) && $filters['is_active'] !== null, fn ($q) => $q->where('is_active', $filters['is_active']))
            ->orderBy('sort_order')
            ->paginate($this->perPage($filters, $perPage))
            ->withQueryString();
    }

    public function listActive(): Collection
    {
        return $this->query()->where('is_active', true)->orderBy('sort_order')->get();
    }
}
