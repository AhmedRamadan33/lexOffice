<nav class="navbar navbar-expand-xl pub-navbar fixed-top" data-bs-theme="dark">
    <div class="container">
        <a class="navbar-brand" href="{{ route('public.home') }}">
            <img src="{{ asset('logo2.png') }}" alt="{{ __('app.app_name') }}">
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#publicNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="publicNavbar">
            <ul class="navbar-nav mx-auto gap-1">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('public.home') ? 'active' : '' }}" href="{{ route('public.home') }}">{{ __('app.public.nav.home') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('public.about') ? 'active' : '' }}" href="{{ route('public.about') }}">{{ __('app.public.nav.about') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('public.services') ? 'active' : '' }}" href="{{ route('public.services') }}">{{ __('app.public.nav.services') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('public.team*') ? 'active' : '' }}" href="{{ route('public.team') }}">{{ __('app.public.nav.team') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('public.stories*') ? 'active' : '' }}" href="{{ route('public.stories') }}">{{ __('app.public.nav.stories') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('public.contact') ? 'active' : '' }}" href="{{ route('public.contact') }}">{{ __('app.public.nav.contact') }}</a>
                </li>
            </ul>

            <div class="d-flex align-items-center gap-2 mt-3 mt-xl-0">
                <form method="POST" id="publicLangForm" class="d-none">
                    @csrf
                </form>
                <div class="dropdown pub-lang-dropdown">
                    <button type="button" class="pub-lang-toggle" data-bs-toggle="dropdown" aria-expanded="false" title="{{ __('app.public.nav.language') }}">
                        <x-flag-icon :code="app()->getLocale() === 'ar' ? 'eg' : 'gb'" />
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end pub-lang-menu">
                        <li>
                            <button type="button" class="dropdown-item" onclick="document.getElementById('publicLangForm').action='{{ route('locale.update', 'ar') }}'; document.getElementById('publicLangForm').submit();">
                                <x-flag-icon code="eg" />
                            </button>
                        </li>
                        <li>
                            <button type="button" class="dropdown-item" onclick="document.getElementById('publicLangForm').action='{{ route('locale.update', 'en') }}'; document.getElementById('publicLangForm').submit();">
                                <x-flag-icon code="gb" />
                            </button>
                        </li>
                    </ul>
                </div>
                <a href="{{ route('login') }}" class="pub-staff-login" title="{{ __('app.public.nav.staff_login') }}">
                    <i class="bi bi-person-badge"></i>
                    <span>{{ __('app.public.nav.staff_login') }}</span>
                </a>
                <a href="{{ route('public.client-portal') }}" class="pub-btn-gold btn-sm">
                    <i class="bi bi-box-arrow-in-{{ app()->getLocale() === 'ar' ? 'left' : 'right' }}"></i>
                    {{ __('app.public.nav.client_portal') }}
                </a>
            </div>
        </div>
    </div>
</nav>
