<x-app-layout :title="__('app.nav.cases')">
    <div class="card">
        <div class="card-header fw-semibold">{{ __('app.actions.edit') }} - {{ $case->case_number }}</div>
        <div class="card-body">
            <form method="POST" action="{{ route('cases.update', $case) }}">
                @csrf
                @method('PUT')
                @include('cases._form')
            </form>
        </div>
    </div>
</x-app-layout>
