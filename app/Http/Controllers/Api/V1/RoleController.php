<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Role\StoreRoleRequest;
use App\Http\Requests\Role\UpdateRoleRequest;
use App\Http\Resources\RoleResource;
use App\Services\RoleService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function __construct(protected RoleService $roles)
    {
    }

    public function index(Request $request): JsonResponse
    {
        $roles = $this->roles->paginate($request->only(['search', 'per_page']));

        return response()->json(RoleResource::collection($roles)->response()->getData(true));
    }

    public function store(StoreRoleRequest $request): JsonResponse
    {
        $role = $this->roles->create($request->validated());

        return response()->json(new RoleResource($role->load('permissions')), 201);
    }

    public function show(Role $role): JsonResponse
    {
        return response()->json(new RoleResource($role->load('permissions')));
    }

    public function update(UpdateRoleRequest $request, Role $role): JsonResponse
    {
        $this->roles->update($role, $request->validated());

        return response()->json(new RoleResource($role->load('permissions')));
    }

    public function destroy(Role $role): JsonResponse
    {
        try {
            $this->roles->delete($role);
        } catch (\DomainException $e) {
            return response()->json(['message' => $e->getMessage()], 422);
        }

        return response()->json(null, 204);
    }
}
