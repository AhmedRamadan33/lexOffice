<x-app-layout :title="__('app.nav.cases')">
    <div class="card">
        <div class="card-header fw-semibold">{{ __('app.actions.add') }} - {{ __('app.labels.case') }}</div>
        <div class="card-body">
            <form method="POST" action="{{ route('cases.store') }}">
                @csrf
                @include('cases._form')
            </form>
        </div>
    </div>
</x-app-layout>
