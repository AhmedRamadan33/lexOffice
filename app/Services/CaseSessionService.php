<?php

namespace App\Services;

use App\Models\CaseModel;
use App\Models\CaseSession;
use App\Repositories\Contracts\CaseSessionRepositoryInterface;
use Illuminate\Pagination\LengthAwarePaginator;

class CaseSessionService
{
    public function __construct(protected CaseSessionRepositoryInterface $sessions)
    {
    }

    public function paginate(array $filters): LengthAwarePaginator
    {
        return $this->sessions->paginate($filters);
    }

    public function create(CaseModel $case, array $data, int $userId): CaseSession
    {
        $data['created_by'] = $userId;

        return $case->sessions()->create($data);
    }

    public function update(CaseSession $session, array $data): CaseSession
    {
        return $this->sessions->update($session, $data);
    }

    public function delete(CaseSession $session): bool
    {
        return $this->sessions->delete($session);
    }
}
