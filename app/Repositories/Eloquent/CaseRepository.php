<?php

namespace App\Repositories\Eloquent;

use App\Models\CaseModel;
use App\Repositories\Contracts\CaseRepositoryInterface;
use Illuminate\Pagination\LengthAwarePaginator;

class CaseRepository extends BaseRepository implements CaseRepositoryInterface
{
    public function __construct(CaseModel $model)
    {
        parent::__construct($model);
    }

    public function paginate(array $filters = [], int $perPage = 15): LengthAwarePaginator
    {
        return $this->query()
            ->with(['client', 'court', 'caseType', 'assignedLawyer'])
            ->when($filters['search'] ?? null, function ($q, $search) {
                $q->where(function ($q) use ($search) {
                    $q->where('case_number', 'like', "%{$search}%")
                        ->orWhere('subject->ar', 'like', "%{$search}%")
                        ->orWhere('subject->en', 'like', "%{$search}%")
                        ->orWhere('opponent_name->ar', 'like', "%{$search}%")
                        ->orWhere('opponent_name->en', 'like', "%{$search}%");
                });
            })
            ->when($filters['status'] ?? null, fn ($q, $status) => $q->where('status', $status))
            ->when($filters['court_id'] ?? null, fn ($q, $courtId) => $q->where('court_id', $courtId))
            ->when($filters['case_type_id'] ?? null, fn ($q, $typeId) => $q->where('case_type_id', $typeId))
            ->when($filters['assigned_lawyer_id'] ?? null, fn ($q, $lawyerId) => $q->where('assigned_lawyer_id', $lawyerId))
            ->latest()
            ->paginate($this->perPage($filters, $perPage))
            ->withQueryString();
    }
}
