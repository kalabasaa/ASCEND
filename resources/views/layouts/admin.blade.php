@props(['title' => null, 'page' => null, 'activity' => false])

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ? $title . ' — Ascend Admin' : 'Ascend Admin' }}</title>
    <link rel="icon" href="{{ asset('assets/logo/ascend-w.png') }}" type="image/png">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/css/admin.css', 'resources/js/app.js', 'resources/js/admin.js'])
</head>
<body class="font-body antialiased h-full" style="color: var(--ink)">

    <a href="#main" class="skip-link">{{ __('Skip to content') }}</a>

    <div class="admin-shell" data-admin-shell>

        <aside class="admin-sidebar" id="admin-sidebar" aria-label="{{ __('Admin navigation') }}">
            @include('partials.admin.nav-panel')
        </aside>
        <div class="admin-overlay" data-overlay="sidebar"></div>

        <div class="admin-body">
            @include('partials.admin.header')

            <div class="admin-workspace">
                @include('partials.admin.main-panel', ['slot' => $slot])

                @if ($activity)
                    @stack('activity-panel')
                @endif
            </div>
        </div>

        @if ($activity)
            <div class="admin-overlay" data-overlay="activity"></div>
        @endif

    </div>

</body>
</html>