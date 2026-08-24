<?php

namespace App\Repositories\Eloquent;

use App\Repositories\Contracts\RoleRepositoryInterface;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

class RoleRepository extends BaseRepository implements RoleRepositoryInterface
{
    public function __construct(Role $model)
    {
        parent::__construct($model);
    }

    public function paginate(array $filters = [], int $perPage = 15): LengthAwarePaginator
    {
        $paginator = $this->query()
            ->when($filters['search'] ?? null, fn ($q, $search) => $q->where('name', 'like', "%{$search}%"))
            ->orderBy('name')
            ->paginate($this->perPage($filters, $perPage))
            ->withQueryString();

        // Deliberately avoid Role::users() (a morphedByMany relying on runtime guard
        // resolution) — it throws under Sanctum-token-authenticated requests. Count
        // directly against the pivot table instead.
        $counts = DB::table('model_has_roles')
            ->whereIn('role_id', $paginator->pluck('id'))
            ->selectRaw('role_id, count(*) as aggregate')
            ->groupBy('role_id')
            ->pluck('aggregate', 'role_id');

        $paginator->getCollection()->each(function (Role $role) use ($counts) {
            $role->users_count = $counts[$role->id] ?? 0;
        });

        return $paginator;
    }
}
