<x-app-layout :title="__('app.nav.tasks')">
    <div class="card">
        <div class="card-header fw-semibold">{{ __('app.actions.add') }} - {{ __('app.nav.tasks') }}</div>
        <div class="card-body">
            <form method="POST" action="{{ route('tasks.store') }}">
                @csrf
                @include('tasks._form')
            </form>
        </div>
    </div>
</x-app-layout>
