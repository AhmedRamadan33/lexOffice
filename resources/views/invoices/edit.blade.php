<x-app-layout :title="__('app.nav.invoices')">
    <div class="card">
        <div class="card-header fw-semibold">{{ __('app.actions.edit') }} - {{ $invoice->invoice_number }}</div>
        <div class="card-body">
            <form method="POST" action="{{ route('invoices.update', $invoice) }}">
                @csrf
                @method('PUT')
                @include('invoices._form')
            </form>
        </div>
    </div>
</x-app-layout>
