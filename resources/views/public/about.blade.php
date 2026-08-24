<x-public-layout :title="__('app.public.nav.about')">
    <section class="pub-hero" style="padding: 3.5rem 0;">
        <div class="container text-center">
            <h1 style="font-size:2rem;">{{ $setting->about_title ?: __('app.public.about.title') }}</h1>
        </div>
    </section>

    <section class="pub-section">
        <div class="container">
            <div class="row align-items-center g-5">
                <div class="col-lg-6 order-lg-2">
                    @if ($setting->hasMedia('about_image'))
                        <img src="{{ $setting->getFirstMediaUrl('about_image') }}" class="img-fluid rounded-4" alt="{{ __('app.app_name') }}">
                    @else
                        <div class="rounded-4" style="aspect-ratio:4/3;background:linear-gradient(135deg,var(--pub-navy),var(--pub-navy-soft));"></div>
                    @endif
                </div>
                <div class="col-lg-6 order-lg-1">
                    @if ($setting->about_body)
                        <p class="fs-5" style="color:var(--pub-ink);">{{ $setting->about_body }}</p>
                    @endif
                </div>
            </div>
        </div>
    </section>

    <section class="pub-section pub-section-alt">
        <div class="container">
            <div class="row g-4">
                @if ($setting->vision_text)
                    <div class="col-md-4">
                        <div class="pub-detail-card">
                            <h6><i class="bi bi-eye-fill text-warning"></i>{{ __('app.public.about.vision') }}</h6>
                            <p class="mt-2 mb-0 small">{{ $setting->vision_text }}</p>
                        </div>
                    </div>
                @endif
                @if ($setting->mission_text)
                    <div class="col-md-4">
                        <div class="pub-detail-card">
                            <h6><i class="bi bi-flag-fill text-warning"></i>{{ __('app.public.about.mission') }}</h6>
                            <p class="mt-2 mb-0 small">{{ $setting->mission_text }}</p>
                        </div>
                    </div>
                @endif
                @if ($setting->values_text)
                    <div class="col-md-4">
                        <div class="pub-detail-card">
                            <h6><i class="bi bi-gem text-warning"></i>{{ __('app.public.about.values') }}</h6>
                            <p class="mt-2 mb-0 small">{{ $setting->values_text }}</p>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </section>

    <div class="container">
        <div class="pub-stats-bar" style="margin-top:0;">
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

    @if ($setting->experience_text)
        <section class="pub-section">
            <div class="container">
                <div class="pub-section-header">
                    <h2>{{ __('app.public.about.experience') }}</h2>
                    <div class="pub-divider"></div>
                    <p class="text-muted mt-3">{{ $setting->experience_text }}</p>
                </div>
            </div>
        </section>
    @endif
</x-public-layout>
