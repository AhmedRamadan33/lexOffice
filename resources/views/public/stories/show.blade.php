<x-public-layout :title="$story->title">
    <section class="pub-section">
        <div class="container" style="max-width:820px;">
            <a href="{{ route('public.stories') }}" class="text-decoration-none small text-muted d-inline-block mb-4">
                <i class="bi bi-arrow-{{ app()->getLocale() === 'ar' ? 'right' : 'left' }} me-1"></i>{{ __('app.public.stories.back') }}
            </a>

            @if ($story->hasMedia('image'))
                <img src="{{ $story->getFirstMediaUrl('image') }}" class="img-fluid rounded-4 mb-4 w-100" style="max-height:360px;object-fit:cover;" alt="{{ $story->title }}">
            @endif

            @if ($story->category)
                <span class="pub-story-category">{{ $story->category }}</span>
            @endif
            <h1 class="mt-2" style="font-size:1.9rem;color:var(--pub-navy);">{{ $story->title }}</h1>
            @if ($story->story_date)
                <p class="text-muted small">{{ $story->story_date->format('Y-m-d') }}</p>
            @endif

            <div class="mt-4" style="color:var(--pub-ink);white-space:pre-line;">{{ $story->body ?: $story->excerpt }}</div>
        </div>
    </section>
</x-public-layout>
