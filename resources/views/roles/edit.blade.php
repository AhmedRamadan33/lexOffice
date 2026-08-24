<x-app-layout :title="__('app.nav.roles')">
    <div class="card">
        <div class="card-header fw-semibold">{{ __('app.actions.edit') }} - {{ $role->name }}</div>
        <div class="card-body">
            <form method="POST" action="{{ route('roles.update', $role) }}">
                @csrf
                @method('PUT')
                @include('roles._form')
            </form>
        </div>
    </div>
</x-app-layout>
