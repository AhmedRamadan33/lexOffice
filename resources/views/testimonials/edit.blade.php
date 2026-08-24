<x-app-layout :title="__('app.nav.testimonials')">
    <div class="card">
        <div class="card-header fw-semibold">{{ __('app.actions.edit') }} - {{ $testimonial->client_name }}</div>
        <div class="card-body">
            <form method="POST" action="{{ route('testimonials.update', $testimonial) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                @include('testimonials._form')
            </form>
        </div>
    </div>
</x-app-layout>
