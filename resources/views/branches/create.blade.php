<x-app-layout :title="__('app.nav.branches')">
    <div class="card">
        <div class="card-header fw-semibold">{{ __('app.actions.add') }} - {{ __('app.nav.branches') }}</div>
        <div class="card-body">
            <form method="POST" action="{{ route('branches.store') }}">
                @csrf
                @include('branches._form')
            </form>
        </div>
    </div>
</x-app-layout>
