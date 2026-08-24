@props(['title' => null])
@php $publicSetting = \App\Models\SiteSetting::current(); @endphp
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
        @vite(['resources/css/public-rtl.css', 'resources/js/public.js'])
    @else
        @vite(['resources/css/public.css', 'resources/js/public.js'])
    @endif
</head>
<body class="pub-body">
    <x-page-loader />

    @include('partials.public-navbar', ['setting' => $publicSetting])

    <main>
        {{ $slot }}
    </main>

    @include('partials.public-footer', ['setting' => $publicSetting])

    <x-toast-container />
</body>
</html>
