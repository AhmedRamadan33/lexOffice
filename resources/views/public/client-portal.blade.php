<x-public-layout :title="__('app.public.client_portal.title')">
    <div class="pub-auth-wrapper">
        <div class="pub-auth-card text-center">
            <img src="{{ asset('logo.png') }}" alt="{{ __('app.app_name') }}" class="pub-auth-logo">
            <h4>{{ __('app.public.client_portal.title') }}</h4>
            <p class="text-muted small mb-4">{{ __('app.public.client_portal.subtitle') }}</p>

            <form method="POST" action="{{ route('public.client-portal.store') }}" class="pub-contact-form text-start">
                @csrf
                <div class="mb-3">
                    <label class="form-label">{{ __('app.public.client_portal.email') }}</label>
                    <input type="email" name="email" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">{{ __('app.public.client_portal.password') }}</label>
                    <input type="password" name="password" class="form-control" required>
                </div>
                <div class="form-check mb-3">
                    <input type="checkbox" name="remember" value="1" id="remember" class="form-check-input">
                    <label for="remember" class="form-check-label small">{{ __('app.public.client_portal.remember_me') }}</label>
                </div>
                <button type="submit" class="pub-btn-gold w-100 justify-content-center">{{ __('app.public.client_portal.login') }}</button>
            </form>

            <p class="small text-muted mt-4 mb-0">
                {{ __('app.public.client_portal.no_account') }}
                <a href="{{ route('public.contact') }}" style="color:var(--pub-gold);font-weight:700;">{{ __('app.public.client_portal.contact_us') }}</a>
            </p>
        </div>
    </div>
</x-public-layout>
