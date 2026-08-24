<x-app-layout :title="__('app.nav.cases')">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="mb-0">{{ __('app.nav.cases') }}</h4>
        <a href="{{ route('cases.create') }}" class="btn btn-primary"><i class="bi bi-plus-lg me-1"></i>{{ __('app.actions.add') }}</a>
    </div>

    <x-table-filters :action="route('cases.index')" :placeholder="__('app.labels.case_number').' / '.__('app.labels.subject')">
        <select name="status" class="form-select" style="width: auto;" onchange="this.form.submit()">
            <option value="">{{ __('app.labels.status') }}</option>
            @foreach (['open', 'pending', 'closed'] as $status)
                <option value="{{ $status }}" @selected(request('status') === $status)>{{ __('app.status.'.$status) }}</option>
            @endforeach
        </select>
        <select name="court_id" class="form-select" style="width: auto;" onchange="this.form.submit()">
            <option value="">{{ __('app.labels.court') }}</option>
            @foreach ($courts as $court)
                <option value="{{ $court->id }}" @selected((int) request('court_id') === $court->id)>{{ $court->name }}</option>
            @endforeach
        </select>
        <select name="assigned_lawyer_id" class="form-select" style="width: auto;" onchange="this.form.submit()">
            <option value="">{{ __('app.labels.assigned_lawyer') }}</option>
            @foreach ($lawyers as $lawyer)
                <option value="{{ $lawyer->id }}" @selected((int) request('assigned_lawyer_id') === $lawyer->id)>{{ $lawyer->name }}</option>
            @endforeach
        </select>
    </x-table-filters>

    <x-table-card :paginator="$cases">
        <table class="table table-hover table-pro align-middle">
            <thead>
                <tr>
                    <th>{{ __('app.labels.case_number') }}</th>
                    <th>{{ __('app.labels.client') }}</th>
                    <th>{{ __('app.labels.court') }}</th>
                    <th>{{ __('app.labels.assigned_lawyer') }}</th>
                    <th>{{ __('app.labels.status') }}</th>
                    <th class="text-end">{{ __('app.actions.edit') }}</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($cases as $case)
                    <tr>
                        <td><a href="{{ route('cases.show', $case) }}" class="fw-semibold text-decoration-none">{{ $case->case_number }}</a></td>
                        <td>{{ $case->client->name ?? '-' }}</td>
                        <td class="cell-muted">{{ $case->court->name ?? '-' }}</td>
                        <td class="cell-muted">{{ $case->assignedLawyer->name ?? '-' }}</td>
                        <td><x-status-badge :status="$case->status" /></td>
                        <td class="text-end">
                            <a href="{{ route('cases.edit', $case) }}" class="btn btn-sm btn-outline-secondary"><i class="bi bi-pencil"></i></a>
                            <x-delete-button :action="route('cases.destroy', $case)" />
                        </td>
                    </tr>
                @empty
                    <x-table-empty colspan="6" />
                @endforelse
            </tbody>
        </table>
    </x-table-card>
</x-app-layout>
