<x-app-layout :title="__('app.nav.roles')">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="mb-0">{{ __('app.nav.roles') }}</h4>
        <a href="{{ route('roles.create') }}" class="btn btn-primary"><i class="bi bi-plus-lg me-1"></i>{{ __('app.actions.add') }}</a>
    </div>

    <x-table-filters :action="route('roles.index')" :placeholder="__('app.labels.name')" />

    <x-table-card :paginator="$roles">
        <table class="table table-hover table-pro align-middle">
            <thead>
                <tr>
                    <th>{{ __('app.labels.name') }}</th>
                    <th>{{ __('app.nav.users') }}</th>
                    <th class="text-end">{{ __('app.actions.actions') }}</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($roles as $role)
                    <tr>
                        <td class="fw-semibold">{{ $role->name }}</td>
                        <td class="cell-muted">{{ $role->users_count }}</td>
                        <td class="text-end">
                            <a href="{{ route('roles.edit', $role) }}" class="btn btn-sm btn-outline-secondary"><i class="bi bi-pencil"></i></a>
                            @if ($role->name !== 'Admin')
                                <x-delete-button :action="route('roles.destroy', $role)" />
                            @endif
                        </td>
                    </tr>
                @empty
                    <x-table-empty colspan="3" />
                @endforelse
            </tbody>
        </table>
    </x-table-card>
</x-app-layout>
