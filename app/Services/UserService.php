<?php

namespace App\Services;

use App\Models\User;
use App\Repositories\Contracts\UserRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Hash;

class UserService
{
    public function __construct(protected UserRepositoryInterface $users)
    {
    }

    public function paginate(array $filters): LengthAwarePaginator
    {
        return $this->users->paginate($filters);
    }

    public function create(array $data, Request $request): User
    {
        $user = $this->users->create([
            'branch_id' => $data['branch_id'],
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'] ?? null,
            'password' => Hash::make($data['password']),
            'is_active' => $data['is_active'],
            ...$this->teamProfileData($data),
        ]);

        $user->syncRoles([$data['role']]);

        if ($request->hasFile('photo')) {
            $user->addMediaFromRequest('photo')->toMediaCollection('photo');
        }

        return $user;
    }

    public function update(User $user, array $data, Request $request): User
    {
        $this->users->update($user, [
            'branch_id' => $data['branch_id'],
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'] ?? null,
            'is_active' => $data['is_active'],
            ...(! empty($data['password']) ? ['password' => Hash::make($data['password'])] : []),
            ...$this->teamProfileData($data),
        ]);

        $user->syncRoles([$data['role']]);

        if ($request->hasFile('photo')) {
            $user->addMediaFromRequest('photo')->toMediaCollection('photo');
        }

        return $user;
    }

    public function delete(User $user, int $currentUserId): bool
    {
        if ($user->id === $currentUserId) {
            throw new \DomainException(__('app.messages.no_results'));
        }

        return $this->users->delete($user);
    }

    private function teamProfileData(array $data): array
    {
        return [
            'title' => $data['title'] ?? null,
            'bio' => $data['bio'] ?? null,
            'specialties' => $data['specialties'] ?? null,
            'education' => $data['education'] ?? null,
            'experience' => $data['experience'] ?? null,
            'category' => $data['category'] ?? null,
            'sort_order' => $data['sort_order'] ?? 0,
            'is_team_visible' => $data['is_team_visible'] ?? false,
        ];
    }
}
