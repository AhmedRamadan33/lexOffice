<x-app-layout :title="__('app.nav.team_members')">
    <div class="card">
        <div class="card-header fw-semibold">{{ __('app.actions.add') }} - {{ __('app.nav.team_members') }}</div>
        <div class="card-body">
            <form method="POST" action="{{ route('team-members.store') }}" enctype="multipart/form-data">
                @csrf
                @include('team-members._form')
            </form>
        </div>
    </div>
</x-app-layout>
