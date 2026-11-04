{{--
    Place at: resources/views/components/layouts/auth.blade.php
    (replaces the default boxed/"card" auth layout the starter kit ships with)

    Used as <x-layouts::auth :title="__('Log in')"> ... </x-layouts::auth>
    exactly like your existing login / register / forgot-password / reset-password pages —
    no changes needed in those files besides what's noted for the terms checkbox.
--}}
@props(['title' => null])

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ? $title . ' — Ascend' : 'Ascend' }}</title>
    <link rel="icon" href="{{ asset('assets/logo/ascend-w.png') }}" type="image/png">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/css/auth.css', 'resources/js/app.js', 'resources/js/auth.js'])
</head>
<body class="font-body bg-white text-[#1C1C1E] antialiased h-full">

    <div class="auth-page">

        {{-- LEFT: full-height hero panel, hidden below lg --}}
        <div class="auth-page__hero">
            <img
                src="{{ asset('assets/image/gym-bro.jpg') }}"
                alt=""
                class="auth-page__hero-img"
            >
            <div class="auth-page__hero-overlay auth-hero-overlay"></div>

            <div class="auth-page__hero-content">
                <a href="{{ url('/') }}" class="inline-block">
                    <img src="{{ asset('assets/logo/ascend-wt2.png') }}" alt="Ascend" class="h-8 w-auto">
                </a>

                <div class="mt-auto max-w-sm">
                    <span class="inline-block text-xs font-medium text-white/80 bg-white/10 border border-white/20 rounded-full px-3 py-1 mb-5">
                        {{ __('For people who show up') }}
                    </span>
                    <h1 class="font-display text-5xl leading-[0.95] text-white">
                        {{ __('Consistency, tracked. One check-in at a time.') }}
                    </h1>
                </div>
            </div>
        </div>

        {{-- RIGHT: form panel, full height, footer pinned to bottom --}}
        <div class="auth-page__form">
            <div class="auth-page__form-inner">

                <a href="{{ url('/') }}" class="mb-10 inline-flex lg:hidden">
                    <img src="{{ asset('assets/logo/ascend-wt2.png') }}" alt="Ascend" class="h-7 w-auto">
                </a>

                {{ $slot }}

            </div>

            <footer class="auth-page__footer">
                &copy; {{ date('Y') }} Ascend. {{ __('All rights reserved.') }}
            </footer>
        </div>

    </div>

</body>
</html>