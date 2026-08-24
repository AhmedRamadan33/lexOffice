<x-app-layout :title="__('app.nav.users')">
    <div class="card">
        <div class="card-header fw-semibold">{{ __('app.actions.edit') }} - {{ $user->name }}</div>
        <div class="card-body">
            <form method="POST" action="{{ route('users.update', $user) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                @include('users._form')
            </form>
        </div>
    </div>
</x-app-layout>
