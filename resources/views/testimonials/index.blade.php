<x-app-layout :title="__('app.nav.testimonials')">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="mb-0">{{ __('app.nav.testimonials') }}</h4>
        <a href="{{ route('testimonials.create') }}" class="btn btn-primary"><i class="bi bi-plus-lg me-1"></i>{{ __('app.actions.add') }}</a>
    </div>

    <x-table-filters :action="route('testimonials.index')" :placeholder="__('app.labels.client_name')">
        <select name="is_active" class="form-select" style="width: auto;" onchange="this.form.submit()">
            <option value="">{{ __('app.labels.is_active') }}</option>
            <option value="1" @selected(request('is_active') === '1')>{{ __('app.labels.is_active') }}</option>
            <option value="0" @selected(request('is_active') === '0')>-</option>
        </select>
    </x-table-filters>

    <x-table-card :paginator="$testimonials">
        <table class="table table-hover table-pro align-middle">
            <thead>
                <tr>
                    <th>{{ __('app.labels.client_name') }}</th>
                    <th>{{ __('app.labels.quote') }}</th>
                    <th>{{ __('app.labels.rating') }}</th>
                    <th>{{ __('app.labels.is_active') }}</th>
                    <th class="text-end">{{ __('app.actions.actions') }}</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($testimonials as $testimonial)
                    <tr>
                        <td class="fw-semibold">{{ $testimonial->client_name }}</td>
                        <td class="cell-muted">{{ \Illuminate\Support\Str::limit($testimonial->quote, 60) }}</td>
                        <td>
                            @for ($i = 1; $i <= 5; $i++)
                                <i class="bi bi-star{{ $i <= $testimonial->rating ? '-fill text-warning' : '' }}"></i>
                            @endfor
                        </td>
                        <td>{{ $testimonial->is_active ? '✓' : '-' }}</td>
                        <td class="text-end">
                            <a href="{{ route('testimonials.edit', $testimonial) }}" class="btn btn-sm btn-outline-secondary"><i class="bi bi-pencil"></i></a>
                            <x-delete-button :action="route('testimonials.destroy', $testimonial)" />
                        </td>
                    </tr>
                @empty
                    <x-table-empty colspan="5" />
                @endforelse
            </tbody>
        </table>
    </x-table-card>
</x-app-layout>
