<x-portal-layout :title="__('app.portal.invoices.title')">
    <section class="pub-section py-4">
        <div class="container">
            <h4 class="mb-4" style="color:var(--pub-navy);">{{ __('app.portal.invoices.title') }}</h4>

            <div class="pub-detail-card">
                <div class="table-responsive">
                    <table class="table align-middle mb-0">
                        <thead>
                            <tr>
                                <th>{{ __('app.labels.invoice_number') }}</th>
                                <th>{{ __('app.labels.total') }}</th>
                                <th>{{ __('app.labels.balance') }}</th>
                                <th>{{ __('app.labels.due_date') }}</th>
                                <th>{{ __('app.labels.status') }}</th>
                                <th class="text-end">{{ __('app.actions.actions') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($invoices as $invoice)
                                <tr>
                                    <td class="fw-semibold">{{ $invoice->invoice_number }}</td>
                                    <td>{{ number_format($invoice->total, 2) }}</td>
                                    <td>{{ number_format($invoice->balance, 2) }}</td>
                                    <td>{{ $invoice->due_date?->format('Y-m-d') ?? '-' }}</td>
                                    <td><x-status-badge :status="$invoice->status" /></td>
                                    <td class="text-end"><a href="{{ route('portal.invoices.show', $invoice) }}" class="btn btn-sm btn-outline-secondary"><i class="bi bi-eye"></i></a></td>
                                </tr>
                            @empty
                                <tr><td colspan="6" class="text-center text-muted py-4">{{ __('app.portal.invoices.empty') }}</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
</x-portal-layout>
