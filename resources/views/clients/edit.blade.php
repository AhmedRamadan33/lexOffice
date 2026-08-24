<x-app-layout :title="__('app.nav.clients')">
    <div class="card">
        <div class="card-header fw-semibold">{{ __('app.actions.edit') }} - {{ $client->name }}</div>
        <div class="card-body">
            <form method="POST" action="{{ route('clients.update', $client) }}">
                @csrf
                @method('PUT')
                @include('clients._form')
            </form>
        </div>
    </div>
</x-app-layout>
