<x-app-layout :title="__('app.nav.tasks')">
    <div class="card">
        <div class="card-header fw-semibold">{{ __('app.actions.edit') }}</div>
        <div class="card-body">
            <form method="POST" action="{{ route('tasks.update', $task) }}">
                @csrf
                @method('PUT')
                @include('tasks._form')
            </form>
        </div>
    </div>
</x-app-layout>
