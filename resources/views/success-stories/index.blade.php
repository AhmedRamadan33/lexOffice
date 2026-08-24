<x-app-layout :title="__('app.nav.success_stories')">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="mb-0">{{ __('app.nav.success_stories') }}</h4>
        <a href="{{ route('success-stories.create') }}" class="btn btn-primary"><i class="bi bi-plus-lg me-1"></i>{{ __('app.actions.add') }}</a>
    </div>

    <x-table-filters :action="route('success-stories.index')" :placeholder="__('app.labels.title')">
        <select name="is_active" class="form-select" style="width: auto;" onchange="this.form.submit()">
            <option value="">{{ __('app.labels.is_active') }}</option>
            <option value="1" @selected(request('is_active') === '1')>{{ __('app.labels.is_active') }}</option>
            <option value="0" @selected(request('is_active') === '0')>-</option>
        </select>
    </x-table-filters>

    <x-table-card :paginator="$stories">
        <table class="table table-hover table-pro align-middle">
            <thead>
                <tr>
                    <th>{{ __('app.labels.title') }}</th>
                    <th>{{ __('app.labels.category') }}</th>
                    <th>{{ __('app.labels.story_date') }}</th>
                    <th>{{ __('app.labels.is_active') }}</th>
                    <th class="text-end">{{ __('app.actions.actions') }}</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($stories as $story)
                    <tr>
                        <td class="fw-semibold">{{ $story->title }}</td>
                        <td class="cell-muted">{{ $story->category ?? '-' }}</td>
                        <td class="cell-muted">{{ $story->story_date?->format('Y-m-d') ?? '-' }}</td>
                        <td>{{ $story->is_active ? '✓' : '-' }}</td>
                        <td class="text-end">
                            <a href="{{ route('success-stories.edit', $story) }}" class="btn btn-sm btn-outline-secondary"><i class="bi bi-pencil"></i></a>
                            <x-delete-button :action="route('success-stories.destroy', $story)" />
                        </td>
                    </tr>
                @empty
                    <x-table-empty colspan="5" />
                @endforelse
            </tbody>
        </table>
    </x-table-card>
</x-app-layout>
