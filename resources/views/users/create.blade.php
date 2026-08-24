<x-app-layout :title="__('app.nav.users')">
    <div class="card">
        <div class="card-header fw-semibold">{{ __('app.actions.add') }} - {{ __('app.nav.users') }}</div>
        <div class="card-body">
            <form method="POST" action="{{ route('users.store') }}" enctype="multipart/form-data">
                @csrf
                @include('users._form')
            </form>
        </div>
    </div>
</x-app-layout>
