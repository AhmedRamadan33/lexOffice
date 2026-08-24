<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\StoreUserRequest;
use App\Http\Requests\User\UpdateUserRequest;
use App\Models\Branch;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function __construct(protected UserService $users)
    {
    }

    public function index(Request $request): View
    {
        $users = $this->users->paginate($request->only(['search', 'branch_id', 'role', 'per_page']));

        return view('users.index', [
            'users' => $users,
            'branches' => Branch::orderBy('name->ar')->get(),
            'roles' => Role::orderBy('name')->get(),
        ]);
    }

    public function create(): View
    {
        return view('users.create', $this->formData());
    }

    public function store(StoreUserRequest $request): RedirectResponse
    {
        $this->users->create($request->validated());

        return redirect()->route('users.index')->with('success', __('app.messages.created'));
    }

    public function show(User $user): View
    {
        return view('users.show', compact('user'));
    }

    public function edit(User $user): View
    {
        return view('users.edit', [...$this->formData(), 'user' => $user]);
    }

    public function update(UpdateUserRequest $request, User $user): RedirectResponse
    {
        $this->users->update($user, $request->validated());

        return redirect()->route('users.index')->with('success', __('app.messages.updated'));
    }

    public function destroy(Request $request, User $user): RedirectResponse
    {
        try {
            $this->users->delete($user, $request->user()->id);
        } catch (\DomainException $e) {
            return back()->withErrors(['user' => $e->getMessage()]);
        }

        return redirect()->route('users.index')->with('success', __('app.messages.deleted'));
    }

    private function formData(): array
    {
        return [
            'branches' => Branch::orderBy('name->ar')->get(),
            'roles' => Role::orderBy('name')->get(),
        ];
    }
}
