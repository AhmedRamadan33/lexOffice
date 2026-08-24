<x-app-layout :title="__('app.nav.clients')">
    <div class="card">
        <div class="card-header fw-semibold">{{ __('app.actions.add') }} - {{ __('app.labels.client') }}</div>
        <div class="card-body">
            <form method="POST" action="{{ route('clients.store') }}">
                @csrf
                @include('clients._form')
            </form>
        </div>
    </div>
</x-app-layout>
