<x-app-layout :title="__('app.nav.roles')">
    <div class="card">
        <div class="card-header fw-semibold">{{ __('app.actions.add') }} - {{ __('app.nav.roles') }}</div>
        <div class="card-body">
            <form method="POST" action="{{ route('roles.store') }}">
                @csrf
                @include('roles._form')
            </form>
        </div>
    </div>
</x-app-layout>
