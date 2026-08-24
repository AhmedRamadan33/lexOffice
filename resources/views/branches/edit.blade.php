<x-app-layout :title="__('app.nav.branches')">
    <div class="card">
        <div class="card-header fw-semibold">{{ __('app.actions.edit') }} - {{ $branch->name }}</div>
        <div class="card-body">
            <form method="POST" action="{{ route('branches.update', $branch) }}">
                @csrf
                @method('PUT')
                @include('branches._form')
            </form>
        </div>
    </div>
</x-app-layout>
