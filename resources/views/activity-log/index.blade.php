<x-app-layout :title="__('app.nav.activity_log')">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="mb-0">{{ __('app.nav.activity_log') }}</h4>
    </div>

    <x-table-filters :action="route('activity-log.index')" :placeholder="__('app.labels.name')">
        <select name="event" class="form-select" style="width: auto;" onchange="this.form.submit()">
            <option value="">{{ __('app.activity_log.all_events') }}</option>
            @foreach (['created', 'updated', 'deleted', 'restored'] as $event)
                <option value="{{ $event }}" @selected(request('event') === $event)>{{ __('app.activity_log.events.'.$event) }}</option>
            @endforeach
        </select>

        <select name="subject_type" class="form-select" style="width: auto;" onchange="this.form.submit()">
            <option value="">{{ __('app.activity_log.all_types') }}</option>
            @foreach ($subjectOptions as $class => $label)
                <option value="{{ $class }}" @selected(request('subject_type') === $class)>{{ $label }}</option>
            @endforeach
        </select>

        @if ($branches->isNotEmpty())
            <select name="branch_id" class="form-select" style="width: auto;" onchange="this.form.submit()">
                <option value="">{{ __('app.activity_log.all_branches') }}</option>
                @foreach ($branches as $branch)
                    <option value="{{ $branch->id }}" @selected((string) request('branch_id') === (string) $branch->id)>{{ $branch->name }}</option>
                @endforeach
            </select>
        @endif
    </x-table-filters>

    <x-table-card :paginator="$logs">
        <table class="table table-hover table-pro align-middle">
            <thead>
                <tr>
                    <th>{{ __('app.labels.created_at') }}</th>
                    <th>{{ __('app.activity_log.causer') }}</th>
                    <th>{{ __('app.activity_log.branch') }}</th>
                    <th>{{ __('app.activity_log.subject_type') }}</th>
                    <th>{{ __('app.activity_log.event') }}</th>
                    <th class="text-end">{{ __('app.activity_log.details') }}</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $eventColors = ['created' => 'success', 'updated' => 'info', 'deleted' => 'danger', 'restored' => 'secondary'];
                @endphp
                @forelse ($logs as $activity)
                    <tr>
                        <td class="cell-muted">{{ $activity->created_at->format('Y-m-d H:i') }}</td>
                        <td class="fw-semibold">{{ $activity->causer?->name ?? __('app.activity_log.system') }}</td>
                        <td class="cell-muted">{{ $activity->causer?->branch?->name ?? '-' }}</td>
                        <td>{{ $activity->subject_label }}</td>
                        <td>
                            @php $color = $eventColors[$activity->event] ?? 'secondary'; @endphp
                            <span class="badge rounded-pill bg-{{ $color }}-subtle text-{{ $color }}-emphasis border border-{{ $color }}-subtle">
                                {{ __('app.activity_log.events.'.$activity->event) }}
                            </span>
                        </td>
                        <td class="text-end">
                            <button type="button" class="btn btn-sm btn-outline-secondary" data-activity-details='@json($activity->formatted_changes)'>
                                <i class="bi bi-eye"></i>
                            </button>
                        </td>
                    </tr>
                @empty
                    <x-table-empty colspan="6" />
                @endforelse
            </tbody>
        </table>
    </x-table-card>
</x-app-layout>
