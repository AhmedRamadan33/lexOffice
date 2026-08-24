<x-app-layout :title="__('app.nav.branches')">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="mb-0">{{ __('app.nav.branches') }}</h4>
        <a href="{{ route('branches.create') }}" class="btn btn-primary"><i class="bi bi-plus-lg me-1"></i>{{ __('app.actions.add') }}</a>
    </div>

    <x-table-filters :action="route('branches.index')" :placeholder="__('app.labels.name').' / '.__('app.labels.phone')">
        <select name="is_active" class="form-select" style="width: auto;" onchange="this.form.submit()">
            <option value="">{{ __('app.labels.is_active') }}</option>
            <option value="1" @selected(request('is_active') === '1')>{{ __('app.labels.is_active') }}</option>
            <option value="0" @selected(request('is_active') === '0')>-</option>
        </select>
    </x-table-filters>

    <x-table-card :paginator="$branches">
        <table class="table table-hover table-pro align-middle">
            <thead>
                <tr>
                    <th>{{ __('app.labels.name') }}</th>
                    <th>{{ __('app.labels.phone') }}</th>
                    <th>{{ __('app.nav.users') }}</th>
                    <th>{{ __('app.labels.is_main') }}</th>
                    <th class="text-end">{{ __('app.actions.edit') }}</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($branches as $branch)
                    <tr>
                        <td class="fw-semibold">{{ $branch->name }}</td>
                        <td class="cell-muted">{{ $branch->phone ?? '-' }}</td>
                        <td>{{ $branch->users_count }}</td>
                        <td>{{ $branch->is_main ? '✓' : '-' }}</td>
                        <td class="text-end">
                            <a href="{{ route('branches.edit', $branch) }}" class="btn btn-sm btn-outline-secondary"><i class="bi bi-pencil"></i></a>
                            <x-delete-button :action="route('branches.destroy', $branch)" />
                        </td>
                    </tr>
                @empty
                    <x-table-empty colspan="5" />
                @endforelse
            </tbody>
        </table>
    </x-table-card>
</x-app-layout>
