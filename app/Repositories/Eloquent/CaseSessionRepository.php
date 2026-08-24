<?php

namespace App\Repositories\Eloquent;

use App\Models\CaseSession;
use App\Repositories\Contracts\CaseSessionRepositoryInterface;
use Illuminate\Pagination\LengthAwarePaginator;

class CaseSessionRepository extends BaseRepository implements CaseSessionRepositoryInterface
{
    public function __construct(CaseSession $model)
    {
        parent::__construct($model);
    }

    public function paginate(array $filters = [], int $perPage = 15): LengthAwarePaginator
    {
        return $this->query()
            ->with(['case.client', 'court'])
            ->when($filters['search'] ?? null, function ($q, $search) {
                $q->whereHas('case', fn ($q) => $q->where('case_number', 'like', "%{$search}%"))
                    ->orWhere('judge_name->ar', 'like', "%{$search}%")
                    ->orWhere('judge_name->en', 'like', "%{$search}%");
            })
            ->when($filters['status'] ?? null, fn ($q, $status) => $q->where('status', $status))
            ->when($filters['court_id'] ?? null, fn ($q, $courtId) => $q->where('court_id', $courtId))
            ->orderBy('session_date')
            ->paginate($this->perPage($filters, $perPage))
            ->withQueryString();
    }
}
