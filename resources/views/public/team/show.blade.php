<x-public-layout :title="$member->name">
    <section class="pub-section">
        <div class="container">
            <a href="{{ route('public.team') }}" class="text-decoration-none small text-muted d-inline-block mb-4">
                <i class="bi bi-arrow-{{ app()->getLocale() === 'ar' ? 'right' : 'left' }} me-1"></i>{{ __('app.public.team.back') }}
            </a>

            <div class="row g-5">
                <div class="col-lg-4">
                    <div class="pub-team-card" style="aspect-ratio:1/1;">
                        @if ($member->hasMedia('photo'))
                            <img src="{{ $member->getFirstMediaUrl('photo') }}" class="pub-team-photo" alt="{{ $member->name }}">
                        @else
                            <div class="pub-avatar-placeholder" style="font-size:3rem;">{{ mb_substr($member->name, 0, 1) }}</div>
                        @endif
                        <div class="pub-team-overlay">
                            <h6 class="fs-5">{{ $member->name }}</h6>
                            <div class="pub-team-title">{{ $member->title }}</div>
                        </div>
                    </div>
                    @if ($member->phone || $member->email)
                        <div class="d-flex justify-content-center gap-2 mt-3">
                            @if ($member->phone)
                                <a href="tel:{{ $member->phone }}" class="pub-contact-icon"><i class="bi bi-telephone-fill"></i></a>
                            @endif
                            @if ($member->email)
                                <a href="mailto:{{ $member->email }}" class="pub-contact-icon"><i class="bi bi-envelope-fill"></i></a>
                            @endif
                        </div>
                    @endif
                </div>

                <div class="col-lg-8">
                    @if ($member->bio)
                        <p class="fs-6 mb-4" style="color:var(--pub-ink);">{{ $member->bio }}</p>
                    @endif

                    <div class="row g-3">
                        @if ($member->specialtiesList())
                            <div class="col-md-4">
                                <div class="pub-detail-card">
                                    <h6><i class="bi bi-briefcase-fill text-warning"></i>{{ __('app.public.team.specialties') }}</h6>
                                    <ul>
                                        @foreach ($member->specialtiesList() as $item)
                                            <li>{{ $item }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        @endif
                        @if ($member->educationList())
                            <div class="col-md-4">
                                <div class="pub-detail-card">
                                    <h6><i class="bi bi-mortarboard-fill text-warning"></i>{{ __('app.public.team.education') }}</h6>
                                    <ul>
                                        @foreach ($member->educationList() as $item)
                                            <li>{{ $item }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        @endif
                        @if ($member->experienceList())
                            <div class="col-md-4">
                                <div class="pub-detail-card">
                                    <h6><i class="bi bi-award-fill text-warning"></i>{{ __('app.public.team.experience') }}</h6>
                                    <ul>
                                        @foreach ($member->experienceList() as $item)
                                            <li>{{ $item }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-public-layout>
