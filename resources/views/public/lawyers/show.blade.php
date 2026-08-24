<x-public-layout :title="$teamMember->name">
    <section class="pub-section">
        <div class="container">
            <a href="{{ route('public.lawyers') }}" class="text-decoration-none small text-muted d-inline-block mb-4">
                <i class="bi bi-arrow-{{ app()->getLocale() === 'ar' ? 'right' : 'left' }} me-1"></i>{{ __('app.public.lawyers.back') }}
            </a>

            <div class="row g-5">
                <div class="col-lg-4">
                    <div class="pub-lawyer-card">
                        @if ($teamMember->hasMedia('photo'))
                            <img src="{{ $teamMember->getFirstMediaUrl('photo') }}" class="pub-lawyer-photo" alt="{{ $teamMember->name }}">
                        @else
                            <div class="pub-avatar-placeholder" style="font-size:3rem;">{{ mb_substr($teamMember->name, 0, 1) }}</div>
                        @endif
                        <div class="pub-lawyer-body text-center">
                            <h6 class="fs-5">{{ $teamMember->name }}</h6>
                            <div class="pub-lawyer-title mb-3">{{ $teamMember->title }}</div>
                            @if ($teamMember->phone || $teamMember->email)
                                <div class="d-flex justify-content-center gap-2">
                                    @if ($teamMember->phone)
                                        <a href="tel:{{ $teamMember->phone }}" class="pub-contact-icon"><i class="bi bi-telephone-fill"></i></a>
                                    @endif
                                    @if ($teamMember->email)
                                        <a href="mailto:{{ $teamMember->email }}" class="pub-contact-icon"><i class="bi bi-envelope-fill"></i></a>
                                    @endif
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="col-lg-8">
                    @if ($teamMember->bio)
                        <p class="fs-6 mb-4" style="color:var(--pub-ink);">{{ $teamMember->bio }}</p>
                    @endif

                    <div class="row g-3">
                        @if ($teamMember->specialtiesList())
                            <div class="col-md-4">
                                <div class="pub-detail-card">
                                    <h6><i class="bi bi-briefcase-fill text-warning"></i>{{ __('app.public.lawyers.specialties') }}</h6>
                                    <ul>
                                        @foreach ($teamMember->specialtiesList() as $item)
                                            <li>{{ $item }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        @endif
                        @if ($teamMember->educationList())
                            <div class="col-md-4">
                                <div class="pub-detail-card">
                                    <h6><i class="bi bi-mortarboard-fill text-warning"></i>{{ __('app.public.lawyers.education') }}</h6>
                                    <ul>
                                        @foreach ($teamMember->educationList() as $item)
                                            <li>{{ $item }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        @endif
                        @if ($teamMember->experienceList())
                            <div class="col-md-4">
                                <div class="pub-detail-card">
                                    <h6><i class="bi bi-award-fill text-warning"></i>{{ __('app.public.lawyers.experience') }}</h6>
                                    <ul>
                                        @foreach ($teamMember->experienceList() as $item)
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
