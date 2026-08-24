<x-app-layout :title="$invoice->invoice_number">
    <div class="d-flex justify-content-between align-items-start mb-3">
        <div>
            <h4 class="mb-0">{{ $invoice->invoice_number }} <x-status-badge :status="$invoice->status" /></h4>
            <span class="text-secondary">{{ $invoice->client->name ?? '-' }}</span>
        </div>
        <a href="{{ route('invoices.edit', $invoice) }}" class="btn btn-outline-secondary"><i class="bi bi-pencil me-1"></i>{{ __('app.actions.edit') }}</a>
    </div>

    <div class="row g-3">
        <div class="col-md-7">
            <div class="card mb-3">
                <div class="card-header fw-semibold">{{ __('app.labels.items') }}</div>
                <div class="table-responsive">
                    <table class="table mb-0">
                        <thead class="table-light">
                            <tr><th>{{ __('app.labels.description') }}</th><th class="text-end">{{ __('app.labels.amount') }}</th></tr>
                        </thead>
                        <tbody>
                            @foreach ($invoice->items as $item)
                                <tr><td>{{ $item->description }}</td><td class="text-end">{{ number_format($item->amount, 2) }}</td></tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr><td class="text-secondary">{{ __('app.labels.subtotal') }}</td><td class="text-end">{{ number_format($invoice->subtotal, 2) }}</td></tr>
                            <tr><td class="text-secondary">{{ __('app.labels.tax') }}</td><td class="text-end">{{ number_format($invoice->tax, 2) }}</td></tr>
                            <tr><td class="text-secondary">{{ __('app.labels.discount') }}</td><td class="text-end">{{ number_format($invoice->discount, 2) }}</td></tr>
                            <tr><td class="fw-bold">{{ __('app.labels.total') }}</td><td class="text-end fw-bold">{{ number_format($invoice->total, 2) }}</td></tr>
                            <tr><td class="text-success">{{ __('app.labels.paid') }}</td><td class="text-end text-success">{{ number_format($invoice->paid_amount, 2) }}</td></tr>
                            <tr><td class="text-danger">{{ __('app.labels.balance') }}</td><td class="text-end text-danger">{{ number_format($invoice->balance, 2) }}</td></tr>
                        </tfoot>
                    </table>
                </div>
            </div>
            @if ($invoice->case)
                <div class="card">
                    <div class="card-body">
                        <span class="text-secondary">{{ __('app.labels.case') }}: </span>
                        <a href="{{ route('cases.show', $invoice->case) }}">{{ $invoice->case->case_number }}</a>
                    </div>
                </div>
            @endif
        </div>

        <div class="col-md-5">
            <div class="card">
                <div class="card-header fw-semibold">{{ __('app.labels.payments') }}</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('invoices.payments.store', $invoice) }}" class="row g-2 mb-3">
                        @csrf
                        <div class="col-6">
                            <input type="number" step="0.01" min="0.01" name="amount" placeholder="{{ __('app.labels.amount') }}" class="form-control" required>
                        </div>
                        <div class="col-6">
                            <input type="date" name="paid_at" value="{{ now()->format('Y-m-d') }}" class="form-control" required>
                        </div>
                        <div class="col-8">
                            <select name="method" class="form-select">
                                <option value="cash">{{ app()->getLocale() === 'ar' ? 'نقدي' : 'Cash' }}</option>
                                <option value="bank_transfer">{{ app()->getLocale() === 'ar' ? 'تحويل بنكي' : 'Bank Transfer' }}</option>
                                <option value="cheque">{{ app()->getLocale() === 'ar' ? 'شيك' : 'Cheque' }}</option>
                                <option value="card">{{ app()->getLocale() === 'ar' ? 'بطاقة' : 'Card' }}</option>
                                <option value="other">{{ app()->getLocale() === 'ar' ? 'أخرى' : 'Other' }}</option>
                            </select>
                        </div>
                        <div class="col-4">
                            <button type="submit" class="btn btn-primary w-100">{{ __('app.actions.add') }}</button>
                        </div>
                    </form>
                    <ul class="list-group list-group-flush">
                        @forelse ($invoice->payments as $payment)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <div>
                                    <div class="fw-semibold">{{ number_format($payment->amount, 2) }}</div>
                                    <div class="small text-secondary">{{ $payment->paid_at->format('Y-m-d') }}</div>
                                </div>
                                <x-delete-button :action="route('payments.destroy', $payment)" />
                            </li>
                        @empty
                            <li class="list-group-item text-secondary">{{ __('app.messages.no_results') }}</li>
                        @endforelse
                    </ul>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
