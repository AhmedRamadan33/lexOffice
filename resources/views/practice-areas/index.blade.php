<x-app-layout :title="__('app.nav.practice_areas')">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="mb-0">{{ __('app.nav.practice_areas') }}</h4>
        <a href="{{ route('practice-areas.create') }}" class="btn btn-primary"><i class="bi bi-plus-lg me-1"></i>{{ __('app.actions.add') }}</a>
    </div>

    <x-table-filters :action="route('practice-areas.index')" :placeholder="__('app.labels.title')">
        <select name="is_active" class="form-select" style="width: auto;" onchange="this.form.submit()">
            <option value="">{{ __('app.labels.is_active') }}</option>
            <option value="1" @selected(request('is_active') === '1')>{{ __('app.labels.is_active') }}</option>
            <option value="0" @selected(request('is_active') === '0')>-</option>
        </select>
    </x-table-filters>

    <x-table-card :paginator="$practiceAreas">
        <table class="table table-hover table-pro align-middle">
            <thead>
                <tr>
                    <th>{{ __('app.labels.icon') }}</th>
                    <th>{{ __('app.labels.title') }}</th>
                    <th>{{ __('app.labels.sort_order') }}</th>
                    <th>{{ __('app.labels.is_active') }}</th>
                    <th class="text-end">{{ __('app.actions.actions') }}</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($practiceAreas as $practiceArea)
                    <tr>
                        <td><i class="bi {{ $practiceArea->icon }} fs-5"></i></td>
                        <td class="fw-semibold">{{ $practiceArea->title }}</td>
                        <td>{{ $practiceArea->sort_order }}</td>
                        <td>{{ $practiceArea->is_active ? '✓' : '-' }}</td>
                        <td class="text-end">
                            <a href="{{ route('practice-areas.edit', $practiceArea) }}" class="btn btn-sm btn-outline-secondary"><i class="bi bi-pencil"></i></a>
                            <x-delete-button :action="route('practice-areas.destroy', $practiceArea)" />
                        </td>
                    </tr>
                @empty
                    <x-table-empty colspan="5" />
                @endforelse
            </tbody>
        </table>
    </x-table-card>
</x-app-layout>
