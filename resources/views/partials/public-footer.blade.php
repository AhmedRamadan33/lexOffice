<footer class="pub-footer">
    <div class="container">
        <div class="row g-4">
            <div class="col-lg-4">
                <a href="{{ route('public.home') }}" class="text-decoration-none">
                    <img src="{{ asset('logo2.png') }}" alt="{{ __('app.app_name') }}" style="height:100px;">
                </a>
                @if ($setting->footer_about_text)
                    <p class="small">{{ $setting->footer_about_text }}</p>
                @endif
                <div class="pub-social-icons mt-3">
                    @if ($setting->facebook_url)
                        <a href="{{ $setting->facebook_url }}" target="_blank" rel="noopener"><i class="bi bi-facebook"></i></a>
                    @endif
                    @if ($setting->twitter_url)
                        <a href="{{ $setting->twitter_url }}" target="_blank" rel="noopener"><i class="bi bi-twitter-x"></i></a>
                    @endif
                    @if ($setting->linkedin_url)
                        <a href="{{ $setting->linkedin_url }}" target="_blank" rel="noopener"><i class="bi bi-linkedin"></i></a>
                    @endif
                    @if ($setting->instagram_url)
                        <a href="{{ $setting->instagram_url }}" target="_blank" rel="noopener"><i class="bi bi-instagram"></i></a>
                    @endif
                    @if ($setting->whatsapp_url)
                        <a href="{{ $setting->whatsapp_url }}" target="_blank" rel="noopener"><i class="bi bi-whatsapp"></i></a>
                    @endif
                </div>
            </div>

            <div class="col-lg-2 col-6">
                <h6>{{ __('app.public.footer.quick_links') }}</h6>
                <ul class="list-unstyled d-flex flex-column gap-2">
                    <li><a href="{{ route('public.about') }}">{{ __('app.public.nav.about') }}</a></li>
                    <li><a href="{{ route('public.services') }}">{{ __('app.public.nav.services') }}</a></li>
                    <li><a href="{{ route('public.team') }}">{{ __('app.public.nav.team') }}</a></li>
                    <li><a href="{{ route('public.stories') }}">{{ __('app.public.nav.stories') }}</a></li>
                </ul>
            </div>

            <div class="col-lg-3 col-6">
                <h6>{{ __('app.public.footer.contact_info') }}</h6>
                <ul class="list-unstyled d-flex flex-column gap-2">
                    @if ($setting->contact_phone_primary)
                        <li><i class="bi bi-telephone me-1"></i>{{ $setting->contact_phone_primary }}</li>
                    @endif
                    @if ($setting->contact_email)
                        <li><i class="bi bi-envelope me-1"></i>{{ $setting->contact_email }}</li>
                    @endif
                    @if ($setting->contact_address)
                        <li><i class="bi bi-geo-alt me-1"></i>{{ $setting->contact_address }}</li>
                    @endif
                </ul>
            </div>

            <div class="col-lg-3">
                <h6>{{ __('app.public.footer.working_hours') }}</h6>
                <p class="small mb-0">{{ $setting->contact_working_hours ?? '-' }}</p>
            </div>
        </div>

        <div class="pub-footer-bottom">
            {{ $setting->footer_copyright ?: __('app.public.footer.rights_reserved', ['year' => date('Y'), 'name' => __('app.app_name')]) }}
        </div>
    </div>
</footer>
