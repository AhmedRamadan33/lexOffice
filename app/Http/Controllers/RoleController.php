<?php

namespace App\Http\Controllers;

use App\Http\Requests\Role\StoreRoleRequest;
use App\Http\Requests\Role\UpdateRoleRequest;
use App\Services\RoleService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function __construct(protected RoleService $roles)
    {
    }

    public function index(Request $request): View
    {
        $roles = $this->roles->paginate($request->only(['search', 'per_page']));

        return view('roles.index', compact('roles'));
    }

    public function create(): View
    {
        $permissions = Permission::orderBy('name')->get();

        return view('roles.create', compact('permissions'));
    }

    public function store(StoreRoleRequest $request): RedirectResponse
    {
        $this->roles->create($request->validated());

        return redirect()->route('roles.index')->with('success', __('app.messages.created'));
    }

    public function edit(Role $role): View
    {
        $permissions = Permission::orderBy('name')->get();

        return view('roles.edit', compact('role', 'permissions'));
    }

    public function update(UpdateRoleRequest $request, Role $role): RedirectResponse
    {
        $this->roles->update($role, $request->validated());

        return redirect()->route('roles.index')->with('success', __('app.messages.updated'));
    }

    public function destroy(Role $role): RedirectResponse
    {
        try {
            $this->roles->delete($role);
        } catch (\DomainException $e) {
            return back()->withErrors(['role' => $e->getMessage()]);
        }

        return redirect()->route('roles.index')->with('success', __('app.messages.deleted'));
    }
}
