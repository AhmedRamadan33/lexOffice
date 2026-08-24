<x-public-layout :title="__('app.public.contact.title')">
    <section class="pub-hero" style="padding: 3.5rem 0;">
        <div class="container text-center">
            <h1 style="font-size:2rem;">{{ __('app.public.contact.title') }}</h1>
            <p class="lead mx-auto">{{ __('app.public.contact.subtitle') }}</p>
        </div>
    </section>

    <section class="pub-section">
        <div class="container">
            <div class="row g-4 mb-5">
                @if ($setting->contact_address)
                    <div class="col-md-4">
                        <div class="pub-contact-card">
                            <div class="pub-contact-icon"><i class="bi bi-geo-alt-fill"></i></div>
                            <h6 class="fw-bold">{{ __('app.public.contact.address') }}</h6>
                            <p class="small text-muted mb-0">{{ $setting->contact_address }}</p>
                        </div>
                    </div>
                @endif
                @if ($setting->contact_phone_primary || $setting->contact_phone_secondary)
                    <div class="col-md-4">
                        <div class="pub-contact-card">
                            <div class="pub-contact-icon"><i class="bi bi-telephone-fill"></i></div>
                            <h6 class="fw-bold">{{ __('app.public.contact.phone_label') }}</h6>
                            <p class="small text-muted mb-0">
                                {{ $setting->contact_phone_primary }}
                                @if ($setting->contact_phone_secondary)
                                    <br>{{ $setting->contact_phone_secondary }}
                                @endif
                            </p>
                        </div>
                    </div>
                @endif
                @if ($setting->contact_working_hours)
                    <div class="col-md-4">
                        <div class="pub-contact-card">
                            <div class="pub-contact-icon"><i class="bi bi-clock-fill"></i></div>
                            <h6 class="fw-bold">{{ __('app.public.contact.working_hours') }}</h6>
                            <p class="small text-muted mb-0">{{ $setting->contact_working_hours }}</p>
                        </div>
                    </div>
                @endif
            </div>

            <div class="row g-5">
                <div class="col-lg-6">
                    <h4 class="fw-bold mb-4" style="color:var(--pub-navy);">{{ __('app.public.contact.form_title') }}</h4>
                    <form method="POST" action="{{ route('public.contact.store') }}" class="pub-contact-form">
                        @csrf
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label">{{ __('app.public.contact.name') }}</label>
                                <input type="text" name="name" value="{{ old('name') }}" class="form-control" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">{{ __('app.public.contact.email') }}</label>
                                <input type="email" name="email" value="{{ old('email') }}" class="form-control" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">{{ __('app.public.contact.phone') }}</label>
                                <input type="text" name="phone" value="{{ old('phone') }}" class="form-control">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">{{ __('app.public.contact.subject') }}</label>
                                <input type="text" name="subject" value="{{ old('subject') }}" class="form-control">
                            </div>
                            <div class="col-12">
                                <label class="form-label">{{ __('app.public.contact.message') }}</label>
                                <textarea name="message" class="form-control" rows="5" required>{{ old('message') }}</textarea>
                            </div>
                        </div>
                        <button type="submit" class="pub-btn-gold mt-3">{{ __('app.public.contact.send') }}</button>
                    </form>
                </div>
                <div class="col-lg-6">
                    @if ($setting->contact_map_embed_url)
                        <iframe src="{{ $setting->contact_map_embed_url }}" class="pub-map-frame" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    @else
                        <div class="pub-map-frame d-flex align-items-center justify-content-center" style="background:var(--pub-bg-alt);">
                            <i class="bi bi-geo-alt display-4 text-muted"></i>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>
</x-public-layout>
