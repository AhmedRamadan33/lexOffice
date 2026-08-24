<?php

namespace App\Repositories\Eloquent;

use App\Models\Task;
use App\Repositories\Contracts\TaskRepositoryInterface;
use Illuminate\Pagination\LengthAwarePaginator;

class TaskRepository extends BaseRepository implements TaskRepositoryInterface
{
    public function __construct(Task $model)
    {
        parent::__construct($model);
    }

    public function paginate(array $filters = [], int $perPage = 15): LengthAwarePaginator
    {
        return $this->query()
            ->with(['case', 'assignee'])
            ->when($filters['search'] ?? null, function ($q, $search) {
                $q->where(fn ($q) => $q->where('title->ar', 'like', "%{$search}%")->orWhere('title->en', 'like', "%{$search}%"));
            })
            ->when($filters['status'] ?? null, fn ($q, $status) => $q->where('status', $status))
            ->when($filters['priority'] ?? null, fn ($q, $priority) => $q->where('priority', $priority))
            ->when($filters['assigned_to'] ?? null, fn ($q, $userId) => $q->where('assigned_to', $userId))
            ->when($filters['mine'] ?? null, fn ($q, $userId) => $q->where('assigned_to', $userId))
            ->orderBy('due_date')
            ->paginate($this->perPage($filters, $perPage))
            ->withQueryString();
    }
}
