@props(['title' => null])
<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title ? $title.' - ' : '' }}{{ __('app.portal.nav.brand') }}</title>

    <link rel="icon" type="image/png" href="{{ asset('logo.png') }}">
    <link rel="shortcut icon" type="image/png" href="{{ asset('logo.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('logo.png') }}">

    @include('partials.page-loader-critical-css')

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;500;600;700;800&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    @if (app()->getLocale() === 'ar')
        @vite(['resources/css/public-rtl.css', 'resources/js/public.js'])
    @else
        @vite(['resources/css/public.css', 'resources/js/public.js'])
    @endif
</head>
<body class="pub-body">
    <x-page-loader />

    <nav class="navbar navbar-expand-lg pub-navbar fixed-top" data-bs-theme="dark">
        <div class="container">
            <a class="navbar-brand" href="{{ route('public.home') }}">
                <img src="{{ asset('logo2.png') }}" alt="{{ __('app.app_name') }}">
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#portalNavbar">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="portalNavbar">
                <ul class="navbar-nav mx-auto gap-1">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('portal.dashboard') ? 'active' : '' }}" href="{{ route('portal.dashboard') }}">{{ __('app.portal.nav.dashboard') }}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('portal.cases.*') ? 'active' : '' }}" href="{{ route('portal.cases.index') }}">{{ __('app.portal.nav.cases') }}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('portal.invoices.*') ? 'active' : '' }}" href="{{ route('portal.invoices.index') }}">{{ __('app.portal.nav.invoices') }}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('portal.documents.*') ? 'active' : '' }}" href="{{ route('portal.documents.index') }}">{{ __('app.portal.nav.documents') }}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('portal.profile.*') ? 'active' : '' }}" href="{{ route('portal.profile.edit') }}">{{ __('app.portal.nav.profile') }}</a>
                    </li>
                </ul>

                <div class="d-flex align-items-center gap-2 mt-3 mt-lg-0">
                    <form method="POST" action="{{ route('locale.update', app()->getLocale() === 'ar' ? 'en' : 'ar') }}">
                        @csrf
                        <button type="submit" class="btn btn-sm pub-btn-outline-light">
                            <i class="bi bi-translate"></i> {{ app()->getLocale() === 'ar' ? 'English' : 'العربية' }}
                        </button>
                    </form>
                    <form method="POST" action="{{ route('portal.logout') }}">
                        @csrf
                        <button type="submit" class="pub-btn-gold btn-sm">
                            <i class="bi bi-box-arrow-{{ app()->getLocale() === 'ar' ? 'left' : 'right' }}"></i>
                            {{ __('app.portal.nav.logout') }}
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    <main>
        {{ $slot }}
    </main>

    <div class="pub-footer-bottom text-center py-4" style="background:var(--pub-navy-deep); color:rgba(255,255,255,.5);">
        {{ __('app.public.footer.rights_reserved', ['year' => date('Y'), 'name' => __('app.app_name')]) }}
    </div>

    <x-toast-container />
</body>
</html>
