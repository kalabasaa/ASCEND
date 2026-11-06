{{--
    Place at: resources/views/components/layouts/auth.blade.php

    Slots:
      - default slot : the form (right panel)
      - left         : badge / heading / text shown at the bottom of the hero (optional)
      - steps        : <div class="auth-step"> cards shown under the hero text (optional)
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
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/css/auth.css', 'resources/js/app.js', 'resources/js/auth.js'])

    @if (config('services.recaptcha.site_key'))
        <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    @endif
</head>
<body class="font-body antialiased h-full" style="color: var(--ink)">

    <div class="auth-shell">
        <div class="auth-frame">

            {{-- LEFT: gradient hero, hidden below lg --}}
            <aside class="auth-hero">
                <img src="{{ asset('assets/image/gym-bro.jpg') }}" alt="" class="auth-hero__img">

                <div class="auth-hero__content">
                    <a href="{{ url('/') }}" class="inline-block self-start">
                        <img src="{{ asset('assets/logo/ascend-wt2.png') }}" alt="Ascend" class="h-8 w-auto">
                    </a>

                    <div class="auth-hero__body">
                        @isset($left)
                            {{ $left }}
                        @else
                            <span class="auth-badge">{{ __('For people who show up') }}</span>
                            <h1 class="auth-hero__title font-display">
                                {{ __('Consistency, tracked. One check-in at a time.') }}
                            </h1>
                        @endisset

                        @isset($steps)
                            <div class="auth-steps">{{ $steps }}</div>
                        @endisset
                    </div>
                </div>
            </aside>

            {{-- RIGHT: form --}}
            <main class="auth-form">
                <div class="auth-form__inner">
                    <a href="{{ url('/') }}" class="mb-8 inline-flex self-center lg:hidden">
                        <img src="{{ asset('assets/logo/ascend-wt2.png') }}" alt="Ascend" class="h-14 w-auto">
                    </a>

                    {{ $slot }}
                </div>

                <footer class="auth-form__footer">
                    &copy; {{ date('Y') }} Ascend. {{ __('All rights reserved.') }}
                </footer>
            </main>

        </div>
    </div>

</body>
</html>