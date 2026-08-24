<?php

namespace App\Repositories\Eloquent;

use App\Models\ContactMessage;
use App\Repositories\Contracts\ContactMessageRepositoryInterface;
use Illuminate\Pagination\LengthAwarePaginator;

class ContactMessageRepository extends BaseRepository implements ContactMessageRepositoryInterface
{
    public function __construct(ContactMessage $model)
    {
        parent::__construct($model);
    }

    public function paginate(array $filters = [], int $perPage = 15): LengthAwarePaginator
    {
        return $this->query()
            ->when($filters['search'] ?? null, function ($q, $search) {
                $q->where(function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%")
                        ->orWhere('subject', 'like', "%{$search}%");
                });
            })
            ->when(array_key_exists('is_read', $filters) && $filters['is_read'] !== null, fn ($q) => $q->where('is_read', $filters['is_read']))
            ->orderByDesc('created_at')
            ->paginate($this->perPage($filters, $perPage))
            ->withQueryString();
    }
}
