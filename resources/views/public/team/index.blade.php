<x-public-layout :title="__('app.public.team.title')">
    <section class="pub-hero" style="padding: 3.5rem 0;">
        <div class="container text-center">
            <h1 style="font-size:2rem;">{{ __('app.public.team.title') }}</h1>
            <p class="lead mx-auto">{{ __('app.public.team.subtitle') }}</p>
        </div>
    </section>

    <section class="pub-section">
        <div class="container">
            @if ($availableCategories->isNotEmpty())
                <div class="pub-filter-tabs">
                    <a href="{{ route('public.team') }}" class="{{ ! $activeCategory ? 'active' : '' }}">{{ __('app.public.team.all') }}</a>
                    @foreach ($availableCategories as $category)
                        <a href="{{ route('public.team', ['category' => $category]) }}" class="{{ $activeCategory === $category ? 'active' : '' }}">{{ __('app.public.team.categories.'.$category) }}</a>
                    @endforeach
                </div>
            @endif

            @forelse ($sections as $section)
                <div class="text-center mb-4 {{ ! $loop->first ? 'mt-5' : '' }}">
                    <h3 style="color:var(--pub-navy); font-weight:800;">{{ $section['members']->count() }} {{ $section['label'] }}</h3>
                    <div class="pub-divider"></div>
                </div>
                <div class="row g-4">
                    @foreach ($section['members'] as $member)
                        <div class="col-6 col-lg-3">
                            <a href="{{ route('public.team.show', $member) }}" class="pub-team-card d-block text-decoration-none">
                                @if ($member->hasMedia('photo'))
                                    <img src="{{ $member->getFirstMediaUrl('photo') }}" class="pub-team-photo" alt="{{ $member->name }}">
                                @else
                                    <div class="pub-avatar-placeholder">{{ mb_substr($member->name, 0, 1) }}</div>
                                @endif
                                <div class="pub-team-overlay">
                                    <h6>{{ $member->name }}</h6>
                                    <div class="pub-team-title">{{ $member->title }}</div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            @empty
                <div class="text-center text-muted">{{ __('app.messages.no_results') }}</div>
            @endforelse
        </div>
    </section>
</x-public-layout>
