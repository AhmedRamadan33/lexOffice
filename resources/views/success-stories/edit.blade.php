<x-app-layout :title="__('app.nav.success_stories')">
    <div class="card">
        <div class="card-header fw-semibold">{{ __('app.actions.edit') }} - {{ $story->title }}</div>
        <div class="card-body">
            <form method="POST" action="{{ route('success-stories.update', $story) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                @include('success-stories._form')
            </form>
        </div>
    </div>
</x-app-layout>
