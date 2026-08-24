<x-app-layout :title="__('app.nav.practice_areas')">
    <div class="card">
        <div class="card-header fw-semibold">{{ __('app.actions.edit') }} - {{ $practiceArea->title }}</div>
        <div class="card-body">
            <form method="POST" action="{{ route('practice-areas.update', $practiceArea) }}">
                @csrf
                @method('PUT')
                @include('practice-areas._form')
            </form>
        </div>
    </div>
</x-app-layout>
