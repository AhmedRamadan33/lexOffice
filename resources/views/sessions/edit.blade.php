<x-app-layout :title="__('app.nav.sessions')">
    <div class="card">
        <div class="card-header fw-semibold">{{ __('app.actions.edit') }} - {{ $case->case_number }}</div>
        <div class="card-body">
            <form method="POST" action="{{ route('cases.sessions.update', [$case, $session]) }}">
                @csrf
                @method('PUT')
                @include('sessions._form')
            </form>
        </div>
    </div>
</x-app-layout>
