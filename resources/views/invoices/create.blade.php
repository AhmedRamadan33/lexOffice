<x-app-layout :title="__('app.nav.invoices')">
    <div class="card">
        <div class="card-header fw-semibold">{{ __('app.actions.add') }} - {{ __('app.nav.invoices') }}</div>
        <div class="card-body">
            <form method="POST" action="{{ route('invoices.store') }}">
                @csrf
                @include('invoices._form')
            </form>
        </div>
    </div>
</x-app-layout>
