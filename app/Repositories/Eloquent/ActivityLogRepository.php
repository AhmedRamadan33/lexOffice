<?php

namespace App\Repositories\Eloquent;

use App\Repositories\Contracts\ActivityLogRepositoryInterface;
use Illuminate\Pagination\LengthAwarePaginator;
use Spatie\Activitylog\Models\Activity;

class ActivityLogRepository extends BaseRepository implements ActivityLogRepositoryInterface
{
    public function __construct(Activity $model)
    {
        parent::__construct($model);
    }

    public function paginate(array $filters = [], int $perPage = 15): LengthAwarePaginator
    {
        return $this->query()
            ->with(['causer.branch'])
            ->when($filters['search'] ?? null, function ($q, $search) {
                $q->where(function ($q) use ($search) {
                    $q->where('description', 'like', "%{$search}%")
                        ->orWhereHasMorph('causer', ['App\\Models\\User'], function ($q) use ($search) {
                            $q->where('name->ar', 'like', "%{$search}%")
                                ->orWhere('name->en', 'like', "%{$search}%");
                        });
                });
            })
            ->when($filters['event'] ?? null, fn ($q, $event) => $q->where('event', $event))
            ->when($filters['subject_type'] ?? null, fn ($q, $type) => $q->where('subject_type', $type))
            ->when($filters['branch_id'] ?? null, function ($q, $branchId) {
                $q->whereHasMorph('causer', ['App\\Models\\User'], function ($q) use ($branchId) {
                    $q->where('branch_id', $branchId);
                });
            })
            ->latest('id')
            ->paginate($this->perPage($filters, $perPage))
            ->withQueryString();
    }
}
