<x-app-layout :title="__('app.nav.success_stories')">
    <div class="card">
        <div class="card-header fw-semibold">{{ __('app.actions.add') }} - {{ __('app.nav.success_stories') }}</div>
        <div class="card-body">
            <form method="POST" action="{{ route('success-stories.store') }}" enctype="multipart/form-data">
                @csrf
                @include('success-stories._form')
            </form>
        </div>
    </div>
</x-app-layout>
