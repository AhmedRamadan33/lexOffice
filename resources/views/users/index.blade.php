<x-app-layout :title="__('app.nav.users')">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="mb-0">{{ __('app.nav.users') }}</h4>
        <a href="{{ route('users.create') }}" class="btn btn-primary"><i class="bi bi-plus-lg me-1"></i>{{ __('app.actions.add') }}</a>
    </div>

    <x-table-filters :action="route('users.index')" :placeholder="__('app.labels.name').' / '.__('app.labels.email')">
        <select name="branch_id" class="form-select" style="width: auto;" onchange="this.form.submit()">
            <option value="">{{ __('app.labels.branch') }}</option>
            @foreach ($branches as $branch)
                <option value="{{ $branch->id }}" @selected((int) request('branch_id') === $branch->id)>{{ $branch->name }}</option>
            @endforeach
        </select>
        <select name="role" class="form-select" style="width: auto;" onchange="this.form.submit()">
            <option value="">{{ __('app.labels.role') }}</option>
            @foreach ($roles as $role)
                <option value="{{ $role->name }}" @selected(request('role') === $role->name)>{{ $role->name }}</option>
            @endforeach
        </select>
    </x-table-filters>

    <x-table-card :paginator="$users">
        <table class="table table-hover table-pro align-middle">
            <thead>
                <tr>
                    <th>{{ __('app.labels.name') }}</th>
                    <th>{{ __('app.labels.email') }}</th>
                    <th>{{ __('app.labels.branch') }}</th>
                    <th>{{ __('app.labels.role') }}</th>
                    <th>{{ __('app.labels.is_active') }}</th>
                    <th class="text-end">{{ __('app.actions.actions') }}</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($users as $user)
                    <tr>
                        <td class="d-flex align-items-center gap-2">
                            <span class="row-avatar">{{ mb_substr($user->name, 0, 1) }}</span>
                            <span class="fw-semibold">{{ $user->name }}</span>
                        </td>
                        <td class="cell-muted">{{ $user->email }}</td>
                        <td>{{ $user->branch->name ?? '-' }}</td>
                        <td>{{ $user->roles->pluck('name')->join(', ') }}</td>
                        <td>
                            @if ($user->is_active)
                                <span class="badge text-bg-success">{{ __('app.labels.is_active') }}</span>
                            @else
                                <span class="badge text-bg-secondary">-</span>
                            @endif
                        </td>
                        <td class="text-end">
                            <a href="{{ route('users.edit', $user) }}" class="btn btn-sm btn-outline-secondary"><i class="bi bi-pencil"></i></a>
                            @if ($user->id !== auth()->id())
                                <x-delete-button :action="route('users.destroy', $user)" />
                            @endif
                        </td>
                    </tr>
                @empty
                    <x-table-empty colspan="6" />
                @endforelse
            </tbody>
        </table>
    </x-table-card>
</x-app-layout>
