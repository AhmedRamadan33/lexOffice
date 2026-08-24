<?php

namespace App\Services;

use App\Repositories\Contracts\RoleRepositoryInterface;
use Illuminate\Pagination\LengthAwarePaginator;
use Spatie\Permission\Models\Role;

class RoleService
{
    public function __construct(protected RoleRepositoryInterface $roles)
    {
    }

    public function paginate(array $filters): LengthAwarePaginator
    {
        return $this->roles->paginate($filters);
    }

    public function create(array $data): Role
    {
        $role = $this->roles->create(['name' => $data['name'], 'guard_name' => 'web']);
        $role->syncPermissions($data['permissions'] ?? []);

        return $role;
    }

    public function update(Role $role, array $data): Role
    {
        $this->roles->update($role, ['name' => $data['name']]);
        $role->syncPermissions($data['permissions'] ?? []);

        return $role;
    }

    public function delete(Role $role): bool
    {
        if ($role->name === 'Admin') {
            throw new \DomainException(__('app.messages.no_results'));
        }

        return $this->roles->delete($role);
    }
}
