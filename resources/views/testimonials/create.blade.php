<x-app-layout :title="__('app.nav.testimonials')">
    <div class="card">
        <div class="card-header fw-semibold">{{ __('app.actions.add') }} - {{ __('app.nav.testimonials') }}</div>
        <div class="card-body">
            <form method="POST" action="{{ route('testimonials.store') }}" enctype="multipart/form-data">
                @csrf
                @include('testimonials._form')
            </form>
        </div>
    </div>
</x-app-layout>
