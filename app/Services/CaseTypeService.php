<?php

namespace App\Services;

use App\Models\CaseType;
use App\Repositories\Contracts\CaseTypeRepositoryInterface;
use Illuminate\Pagination\LengthAwarePaginator;

class CaseTypeService
{
    public function __construct(protected CaseTypeRepositoryInterface $caseTypes)
    {
    }

    public function paginate(array $filters): LengthAwarePaginator
    {
        return $this->caseTypes->paginate($filters);
    }

    public function create(array $data): CaseType
    {
        return $this->caseTypes->create($data);
    }

    public function update(CaseType $caseType, array $data): CaseType
    {
        return $this->caseTypes->update($caseType, $data);
    }

    public function delete(CaseType $caseType): bool
    {
        return $this->caseTypes->delete($caseType);
    }
}
