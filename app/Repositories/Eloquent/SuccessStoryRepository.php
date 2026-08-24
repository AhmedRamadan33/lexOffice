<?php

namespace App\Repositories\Eloquent;

use App\Models\SuccessStory;
use App\Repositories\Contracts\SuccessStoryRepositoryInterface;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class SuccessStoryRepository extends BaseRepository implements SuccessStoryRepositoryInterface
{
    public function __construct(SuccessStory $model)
    {
        parent::__construct($model);
    }

    public function paginate(array $filters = [], int $perPage = 15): LengthAwarePaginator
    {
        return $this->query()
            ->when($filters['search'] ?? null, function ($q, $search) {
                $q->where(function ($q) use ($search) {
                    $q->where('title->ar', 'like', "%{$search}%")
                        ->orWhere('title->en', 'like', "%{$search}%");
                });
            })
            ->when($filters['category'] ?? null, fn ($q, $category) => $q->where('category', $category))
            ->when(array_key_exists('is_active', $filters) && $filters['is_active'] !== null, fn ($q) => $q->where('is_active', $filters['is_active']))
            ->orderByDesc('story_date')
            ->orderBy('sort_order')
            ->paginate($this->perPage($filters, $perPage))
            ->withQueryString();
    }

    public function listActive(): Collection
    {
        return $this->query()->where('is_active', true)->orderByDesc('story_date')->orderBy('sort_order')->get();
    }
}
