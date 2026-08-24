<?php

namespace App\Services;

use App\Models\TeamMember;
use App\Repositories\Contracts\TeamMemberRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class TeamMemberService
{
    public function __construct(protected TeamMemberRepositoryInterface $teamMembers)
    {
    }

    public function paginate(array $filters): LengthAwarePaginator
    {
        return $this->teamMembers->paginate($filters);
    }

    public function listActive(): Collection
    {
        return $this->teamMembers->listActive();
    }

    public function create(array $data, Request $request): TeamMember
    {
        $teamMember = $this->teamMembers->create($data);

        if ($request->hasFile('photo')) {
            $teamMember->addMediaFromRequest('photo')->toMediaCollection('photo');
        }

        return $teamMember;
    }

    public function update(TeamMember $teamMember, array $data, Request $request): TeamMember
    {
        $this->teamMembers->update($teamMember, $data);

        if ($request->hasFile('photo')) {
            $teamMember->addMediaFromRequest('photo')->toMediaCollection('photo');
        }

        return $teamMember;
    }

    public function delete(TeamMember $teamMember): bool
    {
        return $this->teamMembers->delete($teamMember);
    }
}
