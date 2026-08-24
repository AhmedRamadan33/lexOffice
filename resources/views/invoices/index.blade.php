<x-app-layout :title="__('app.nav.invoices')">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="mb-0">{{ __('app.nav.invoices') }}</h4>
        <a href="{{ route('invoices.create') }}" class="btn btn-primary"><i class="bi bi-plus-lg me-1"></i>{{ __('app.actions.add') }}</a>
    </div>

    <x-table-filters :action="route('invoices.index')" :placeholder="__('app.labels.invoice_number')">
        <select name="status" class="form-select" style="width: auto;" onchange="this.form.submit()">
            <option value="">{{ __('app.labels.status') }}</option>
            @foreach (['unpaid', 'partial', 'paid'] as $status)
                <option value="{{ $status }}" @selected(request('status') === $status)>{{ __('app.status.'.$status) }}</option>
            @endforeach
        </select>
        <select name="client_id" class="form-select" style="width: auto;" onchange="this.form.submit()">
            <option value="">{{ __('app.labels.client') }}</option>
            @foreach ($clients as $client)
                <option value="{{ $client->id }}" @selected((int) request('client_id') === $client->id)>{{ $client->name }}</option>
            @endforeach
        </select>
    </x-table-filters>

    <x-table-card :paginator="$invoices">
        <table class="table table-hover table-pro align-middle">
            <thead>
                <tr>
                    <th>{{ __('app.labels.invoice_number') }}</th>
                    <th>{{ __('app.labels.client') }}</th>
                    <th class="text-end">{{ __('app.labels.total') }}</th>
                    <th>{{ __('app.labels.due_date') }}</th>
                    <th>{{ __('app.labels.status') }}</th>
                    <th class="text-end">{{ __('app.actions.edit') }}</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($invoices as $invoice)
                    <tr>
                        <td><a href="{{ route('invoices.show', $invoice) }}" class="fw-semibold text-decoration-none">{{ $invoice->invoice_number }}</a></td>
                        <td>{{ $invoice->client->name ?? '-' }}</td>
                        <td class="cell-num">{{ number_format($invoice->total, 2) }}</td>
                        <td class="cell-muted">{{ $invoice->due_date?->format('Y-m-d') ?? '-' }}</td>
                        <td><x-status-badge :status="$invoice->status" /></td>
                        <td class="text-end">
                            <a href="{{ route('invoices.edit', $invoice) }}" class="btn btn-sm btn-outline-secondary"><i class="bi bi-pencil"></i></a>
                            <x-delete-button :action="route('invoices.destroy', $invoice)" />
                        </td>
                    </tr>
                @empty
                    <x-table-empty colspan="6" />
                @endforelse
            </tbody>
        </table>
    </x-table-card>
</x-app-layout>
