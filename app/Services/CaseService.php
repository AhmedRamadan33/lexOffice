<?php

namespace App\Services;

use App\Models\CaseModel;
use App\Repositories\Contracts\CaseRepositoryInterface;
use Illuminate\Pagination\LengthAwarePaginator;

class CaseService
{
    public function __construct(protected CaseRepositoryInterface $cases)
    {
    }

    public function paginate(array $filters): LengthAwarePaginator
    {
        return $this->cases->paginate($filters);
    }

    public function create(array $data, int $userId): CaseModel
    {
        $data['case_number'] = $this->generateCaseNumber();
        $data['created_by'] = $userId;

        $case = $this->cases->create($data);
        $case->clients()->syncWithoutDetaching([$data['client_id']]);

        return $case;
    }

    public function update(CaseModel $case, array $data): CaseModel
    {
        $this->cases->update($case, $data);
        $case->clients()->syncWithoutDetaching([$data['client_id']]);

        return $case;
    }

    public function delete(CaseModel $case): bool
    {
        return $this->cases->delete($case);
    }

    private function generateCaseNumber(): string
    {
        $year = now()->year;

        do {
            $sequence = CaseModel::withTrashed()->whereYear('created_at', $year)->count() + 1;
            $number = sprintf('C-%d-%04d', $year, $sequence);
        } while (CaseModel::withTrashed()->where('case_number', $number)->exists());

        return $number;
    }
}
