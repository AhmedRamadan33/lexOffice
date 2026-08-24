<x-public-layout :title="__('app.public.stories.title')">
    <section class="pub-hero" style="padding: 3.5rem 0;">
        <div class="container text-center">
            <h1 style="font-size:2rem;">{{ __('app.public.stories.title') }}</h1>
            <p class="lead mx-auto">{{ __('app.public.stories.subtitle') }}</p>
        </div>
    </section>

    <section class="pub-section">
        <div class="container">
            <div class="row g-4">
                @forelse ($stories as $story)
                    <div class="col-md-4">
                        <a href="{{ route('public.stories.show', $story) }}" class="pub-story-card d-block text-decoration-none">
                            @if ($story->hasMedia('image'))
                                <img src="{{ $story->getFirstMediaUrl('image') }}" class="pub-story-image" alt="{{ $story->title }}">
                            @else
                                <div class="pub-story-image"></div>
                            @endif
                            <div class="pub-story-body">
                                @if ($story->category)
                                    <span class="pub-story-category">{{ $story->category }}</span>
                                @endif
                                <h6 class="fw-bold">{{ $story->title }}</h6>
                                <p class="text-muted small mb-2">{{ \Illuminate\Support\Str::limit((string) $story->excerpt, 90) }}</p>
                                <span class="small fw-semibold" style="color:var(--pub-gold);">{{ __('app.public.stories.read_more') }} &raquo;</span>
                            </div>
                        </a>
                    </div>
                @empty
                    <div class="col-12 text-center text-muted">{{ __('app.messages.no_results') }}</div>
                @endforelse
            </div>
        </div>
    </section>
</x-public-layout>
