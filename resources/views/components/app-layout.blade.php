@props(['title' => null])
<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title ? $title.' - ' : '' }}{{ __('app.app_name') }}</title>

    <link rel="icon" type="image/png" href="{{ asset('logo.png') }}">
    <link rel="shortcut icon" type="image/png" href="{{ asset('logo.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('logo.png') }}">

    @include('partials.page-loader-critical-css')

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;500;600;700;800&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    @if (app()->getLocale() === 'ar')
        @vite(['resources/css/app-rtl.css', 'resources/js/app.js'])
    @else
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif
</head>
<body>
    <x-page-loader />

    <div class="d-flex">
        <aside class="lo-sidebar d-none d-md-flex flex-column p-3">
            <a href="{{ route('dashboard') }}" class="d-flex align-items-center gap-2 text-decoration-none">
                <img src="{{ asset('logo.png') }}" alt="{{ __('app.app_name') }}" class="brand-logo">
            </a>
            @include('partials.sidebar-nav')
        </aside>

        <div class="offcanvas offcanvas-start lo-sidebar" tabindex="-1" id="mobileSidebar">
            <div class="offcanvas-header">
                <span class="d-flex align-items-center gap-2">
                    <img src="{{ asset('logo.png') }}" alt="{{ __('app.app_name') }}" class="brand-logo">
                </span>
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas"></button>
            </div>
            <div class="offcanvas-body d-flex flex-column p-3 pt-0">
                @include('partials.sidebar-nav')
            </div>
        </div>

        <div class="flex-grow-1" style="min-width: 0;">
            <nav class="lo-topbar d-flex align-items-center justify-content-between px-4">
                <div class="d-flex align-items-center gap-3">
                    <button class="icon-btn d-md-none" type="button" data-bs-toggle="offcanvas" data-bs-target="#mobileSidebar">
                        <i class="bi bi-list"></i>
                    </button>
                    <div class="page-title">{{ $title }}</div>
                </div>
                <div class="d-flex align-items-center gap-2">
                    <form method="POST" action="{{ route('locale.update', app()->getLocale() === 'ar' ? 'en' : 'ar') }}">
                        @csrf
                        <button type="submit" class="btn btn-sm btn-outline-secondary rounded-pill px-3">
                            <i class="bi bi-translate me-1"></i>{{ app()->getLocale() === 'ar' ? 'English' : 'العربية' }}
                        </button>
                    </form>
                    <div class="dropdown">
                        @php $unread = auth()->user()->unreadNotifications; @endphp
                        <button class="icon-btn position-relative" data-bs-toggle="dropdown">
                            <i class="bi bi-bell"></i>
                            @if ($unread->count())
                                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">{{ $unread->count() }}</span>
                            @endif
                        </button>
                        <div class="dropdown-menu dropdown-menu-end p-0" style="width: 320px;">
                            <div class="p-2 border-bottom fw-semibold">{{ __('app.nav.notifications') }}</div>
                            <div style="max-height: 300px; overflow-y: auto;">
                                @forelse ($unread->take(8) as $notification)
                                    <form method="POST" action="{{ route('notifications.read', $notification->id) }}" class="border-bottom">
                                        @csrf
                                        <button type="submit" class="dropdown-item small py-2 white-space-normal">
                                            {{ __($notification->data['message_key'], $notification->data) }}
                                        </button>
                                    </form>
                                @empty
                                    <div class="p-3 text-secondary small">{{ __('app.notifications.empty') }}</div>
                                @endforelse
                            </div>
                            <a href="{{ route('notifications.index') }}" class="dropdown-item text-center small p-2 border-top">{{ __('app.actions.view_all') }}</a>
                        </div>
                    </div>
                    <div class="dropdown">
                        <button class="user-chip dropdown-toggle" data-bs-toggle="dropdown">
                            <span class="avatar">{{ mb_substr(auth()->user()->name, 0, 1) }}</span>
                            <span>{{ auth()->user()->name }}</span>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="dropdown-item">
                                        <i class="bi bi-box-arrow-{{ app()->getLocale() === 'ar' ? 'left' : 'right' }} me-2"></i>
                                        {{ __('app.nav.logout') }}
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>

            <main class="lo-content p-4">
                @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <ul class="mb-0 ps-3">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                {{ $slot }}
            </main>
        </div>
    </div>

    <x-toast-container />
    <x-confirm-modal />
    <x-activity-details-modal />
</body>
</html>
