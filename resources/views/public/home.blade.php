<x-public-layout :title="__('app.public.nav.home')">
    <section class="pub-hero {{ $setting->hasMedia('hero_image') ? 'has-image' : '' }}"
        @if ($setting->hasMedia('hero_image')) style="background-image: url('{{ $setting->getFirstMediaUrl('hero_image') }}')" @endif>
        <div class="container text-center text-md-start">
            <div class="pub-eyebrow mb-2">{{ __('app.public.home.hero_eyebrow') }}</div>
            <h1>{{ $setting->hero_title ?: __('app.app_name') }}</h1>
            @if ($setting->hero_subtitle)
                <p class="lead mx-auto mx-md-0">{{ $setting->hero_subtitle }}</p>
            @endif
            <div class="d-flex flex-wrap justify-content-center justify-content-md-start gap-2 mt-4">
                @if ($setting->hero_cta_primary_text)
                    <a href="{{ $setting->hero_cta_primary_url ?: route('public.contact') }}" class="pub-btn-gold">
                        {{ $setting->hero_cta_primary_text }}
                    </a>
                @endif
                @if ($setting->hero_cta_secondary_text)
                    <a href="{{ $setting->hero_cta_secondary_url ?: route('public.about') }}" class="pub-btn-outline-light">
                        {{ $setting->hero_cta_secondary_text }}
                    </a>
                @endif
            </div>
        </div>
    </section>

    <div class="container">
        <div class="pub-stats-bar">
            <div class="row g-3">
                @for ($i = 1; $i <= 4; $i++)
                    @php $value = $setting->{'stat'.$i.'_value'}; @endphp
                    @if ($value)
                        <div class="col-6 col-md-3">
                            <div class="pub-stat">
                                <div class="pub-stat-value">{{ $value }}</div>
                                <div class="pub-stat-label">{{ $setting->{'stat'.$i.'_label'} }}</div>
                            </div>
                        </div>
                    @endif
                @endfor
            </div>
        </div>
    </div>

    <section class="pub-section">
        <div class="container">
            <div class="pub-section-header">
                <div class="pub-eyebrow">{{ __('app.public.home.services_eyebrow') }}</div>
                <h2>{{ __('app.public.home.services_title') }}</h2>
                <div class="pub-divider"></div>
            </div>
            <div class="row g-4">
                @foreach ($practiceAreas as $practiceArea)
                    <div class="col-md-6 col-lg-4">
                        <div class="pub-service-card">
                            <div class="pub-service-icon"><i class="bi {{ $practiceArea->icon }}"></i></div>
                            <h5>{{ $practiceArea->title }}</h5>
                            <p>{{ \Illuminate\Support\Str::limit((string) $practiceArea->description, 100) }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="text-center mt-4">
                <a href="{{ route('public.services') }}" class="pub-btn-gold">{{ __('app.public.home.view_all_services') }}</a>
            </div>
        </div>
    </section>

    @if ($teamMembers->isNotEmpty())
        <section class="pub-section pub-section-alt">
            <div class="container">
                <div class="pub-section-header">
                    <div class="pub-eyebrow">{{ __('app.public.home.team_eyebrow') }}</div>
                    <h2>{{ __('app.public.home.team_title') }}</h2>
                    <div class="pub-divider"></div>
                </div>
                <div class="row g-4">
                    @foreach ($teamMembers as $member)
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
                <div class="text-center mt-4">
                    <a href="{{ route('public.team') }}" class="pub-btn-gold">{{ __('app.public.home.view_all_team') }}</a>
                </div>
            </div>
        </section>
    @endif

    <section class="pub-section">
        <div class="container">
            <div class="pub-cta-banner">
                <h3>{{ __('app.public.home.cta_title') }}</h3>
                <p>{{ __('app.public.home.cta_subtitle') }}</p>
                <a href="{{ route('public.contact') }}" class="pub-btn-gold">{{ __('app.public.home.cta_button') }}</a>
            </div>
        </div>
    </section>

    @if ($testimonials->isNotEmpty())
        <section class="pub-section pub-section-alt">
            <div class="container">
                <div class="pub-section-header">
                    <div class="pub-eyebrow">{{ __('app.public.home.testimonials_eyebrow') }}</div>
                    <h2>{{ __('app.public.home.testimonials_title') }}</h2>
                    <div class="pub-divider"></div>
                </div>
                <div class="row g-4">
                    @foreach ($testimonials->take(3) as $testimonial)
                        <div class="col-md-4">
                            <div class="pub-testimonial-card">
                                <div class="pub-stars">
                                    @for ($i = 1; $i <= 5; $i++)
                                        <i class="bi bi-star{{ $i <= $testimonial->rating ? '-fill' : '' }}"></i>
                                    @endfor
                                </div>
                                <p class="pub-quote">"{{ $testimonial->quote }}"</p>
                                <div class="pub-client">
                                    @if ($testimonial->hasMedia('photo'))
                                        <img src="{{ $testimonial->getFirstMediaUrl('photo') }}" class="pub-avatar-placeholder-sm" style="object-fit:cover;" alt="{{ $testimonial->client_name }}">
                                    @else
                                        <div class="pub-avatar-placeholder pub-avatar-placeholder-sm">{{ mb_substr($testimonial->client_name, 0, 1) }}</div>
                                    @endif
                                    <div class="pub-client-name">{{ $testimonial->client_name }}</div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    @if ($stories->isNotEmpty())
        <section class="pub-section">
            <div class="container">
                <div class="pub-section-header">
                    <div class="pub-eyebrow">{{ __('app.public.home.stories_eyebrow') }}</div>
                    <h2>{{ __('app.public.home.stories_title') }}</h2>
                    <div class="pub-divider"></div>
                </div>
                <div class="row g-4">
                    @foreach ($stories as $story)
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
                                    <p class="text-muted small mb-0">{{ \Illuminate\Support\Str::limit((string) $story->excerpt, 90) }}</p>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
                <div class="text-center mt-4">
                    <a href="{{ route('public.stories') }}" class="pub-btn-gold">{{ __('app.public.home.view_all_stories') }}</a>
                </div>
            </div>
        </section>
    @endif
</x-public-layout>
