<x-app-layout :title="__('app.nav.expenses')">
    <div class="card">
        <div class="card-header fw-semibold">{{ __('app.actions.edit') }}</div>
        <div class="card-body">
            <form method="POST" action="{{ route('expenses.update', $expense) }}">
                @csrf
                @method('PUT')
                @include('expenses._form')
            </form>
        </div>
    </div>
</x-app-layout>
