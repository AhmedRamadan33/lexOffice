<x-public-layout :title="__('app.public.services.title')">
    <section class="pub-hero" style="padding: 3.5rem 0;">
        <div class="container text-center">
            <h1 style="font-size:2rem;">{{ __('app.public.services.title') }}</h1>
            <p class="lead mx-auto">{{ __('app.public.services.subtitle') }}</p>
        </div>
    </section>

    <section class="pub-section">
        <div class="container">
            <div class="row g-4">
                @forelse ($practiceAreas as $practiceArea)
                    <div class="col-md-6 col-lg-4">
                        <div class="pub-service-card">
                            <div class="pub-service-icon"><i class="bi {{ $practiceArea->icon }}"></i></div>
                            <h5>{{ $practiceArea->title }}</h5>
                            <p>{{ $practiceArea->description }}</p>
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center text-muted">{{ __('app.messages.no_results') }}</div>
                @endforelse
            </div>
        </div>
    </section>
</x-public-layout>
