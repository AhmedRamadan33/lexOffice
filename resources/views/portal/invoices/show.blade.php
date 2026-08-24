<x-portal-layout :title="$invoice->invoice_number">
    <section class="pub-section py-4">
        <div class="container">
            <a href="{{ route('portal.invoices.index') }}" class="text-decoration-none small text-muted d-inline-block mb-3">
                <i class="bi bi-arrow-{{ app()->getLocale() === 'ar' ? 'right' : 'left' }} me-1"></i>{{ __('app.portal.invoices.back') }}
            </a>

            <div class="d-flex justify-content-between align-items-start mb-4">
                <h4 class="mb-0" style="color:var(--pub-navy);">{{ $invoice->invoice_number }}</h4>
                <x-status-badge :status="$invoice->status" />
            </div>

            <div class="row g-3 mb-4">
                <div class="col-md-3 col-6"><div class="pub-detail-card"><div class="small text-muted">{{ __('app.labels.total') }}</div><div class="fw-semibold">{{ number_format($invoice->total, 2) }}</div></div></div>
                <div class="col-md-3 col-6"><div class="pub-detail-card"><div class="small text-muted">{{ __('app.labels.paid') }}</div><div class="fw-semibold">{{ number_format($invoice->paid_amount, 2) }}</div></div></div>
                <div class="col-md-3 col-6"><div class="pub-detail-card"><div class="small text-muted">{{ __('app.labels.balance') }}</div><div class="fw-semibold">{{ number_format($invoice->balance, 2) }}</div></div></div>
                <div class="col-md-3 col-6"><div class="pub-detail-card"><div class="small text-muted">{{ __('app.labels.due_date') }}</div><div class="fw-semibold">{{ $invoice->due_date?->format('Y-m-d') ?? '-' }}</div></div></div>
            </div>

            <div class="row g-3">
                <div class="col-lg-7">
                    <div class="pub-detail-card">
                        <h6><i class="bi bi-list-ul text-warning"></i>{{ __('app.portal.invoices.items_title') }}</h6>
                        @forelse ($invoice->items as $item)
                            <div class="d-flex justify-content-between border-bottom py-2">
                                <span>{{ $item->description }}</span>
                                <span class="fw-semibold">{{ number_format($item->amount, 2) }}</span>
                            </div>
                        @empty
                            <p class="text-muted small mb-0 mt-2">{{ __('app.messages.no_results') }}</p>
                        @endforelse
                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="pub-detail-card">
                        <h6><i class="bi bi-cash-coin text-warning"></i>{{ __('app.portal.invoices.payments_title') }}</h6>
                        @forelse ($invoice->payments as $payment)
                            <div class="d-flex justify-content-between border-bottom py-2">
                                <div>
                                    <div class="fw-semibold">{{ number_format($payment->amount, 2) }}</div>
                                    <div class="small text-muted">{{ $payment->paid_at?->format('Y-m-d') }}</div>
                                </div>
                                <span class="small text-muted align-self-center">{{ $payment->method }}</span>
                            </div>
                        @empty
                            <p class="text-muted small mb-0 mt-2">{{ __('app.messages.no_results') }}</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-portal-layout>
