<x-app-layout :title="__('app.nav.sessions')">
    <h4 class="mb-3">{{ __('app.nav.sessions') }}</h4>

    <x-table-filters :action="route('sessions.index')" :placeholder="__('app.labels.case_number')">
        <select name="status" class="form-select" style="width: auto;" onchange="this.form.submit()">
            <option value="">{{ __('app.labels.status') }}</option>
            @foreach (['scheduled', 'held', 'postponed'] as $status)
                <option value="{{ $status }}" @selected(request('status') === $status)>{{ __('app.status.'.$status) }}</option>
            @endforeach
        </select>
        <select name="court_id" class="form-select" style="width: auto;" onchange="this.form.submit()">
            <option value="">{{ __('app.labels.court') }}</option>
            @foreach ($courts as $court)
                <option value="{{ $court->id }}" @selected((int) request('court_id') === $court->id)>{{ $court->name }}</option>
            @endforeach
        </select>
    </x-table-filters>

    <x-table-card :paginator="$sessions">
        <table class="table table-hover table-pro align-middle">
            <thead>
                <tr>
                    <th>{{ __('app.labels.session_date') }}</th>
                    <th>{{ __('app.labels.case') }}</th>
                    <th>{{ __('app.labels.client') }}</th>
                    <th>{{ __('app.labels.court') }}</th>
                    <th>{{ __('app.labels.status') }}</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($sessions as $session)
                    <tr>
                        <td>{{ $session->session_date->format('Y-m-d') }}</td>
                        <td><a href="{{ route('cases.show', $session->case) }}" class="fw-semibold text-decoration-none">{{ $session->case->case_number }}</a></td>
                        <td class="cell-muted">{{ $session->case->client->name ?? '-' }}</td>
                        <td class="cell-muted">{{ $session->court->name ?? '-' }}</td>
                        <td><x-status-badge :status="$session->status" /></td>
                    </tr>
                @empty
                    <x-table-empty colspan="5" />
                @endforelse
            </tbody>
        </table>
    </x-table-card>
</x-app-layout>
