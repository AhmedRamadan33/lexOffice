<x-app-layout :title="__('app.nav.team_members')">
    <div class="card">
        <div class="card-header fw-semibold">{{ __('app.actions.edit') }} - {{ $teamMember->name }}</div>
        <div class="card-body">
            <form method="POST" action="{{ route('team-members.update', $teamMember) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                @include('team-members._form')
            </form>
        </div>
    </div>
</x-app-layout>
