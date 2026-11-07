@props(['title' => null])

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
    <title>{{ $title ? $title . ' — Ascend' : 'Ascend' }}</title>
    <link rel="icon" href="{{ asset('assets/logo/ascend-w.png') }}" type="image/png">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/css/user.css', 'resources/js/app.js', 'resources/js/user.js'])
</head>
<body class="font-body antialiased h-full" style="color: var(--ink)">

    <div class="user-shell">
        @include('partials.user.nav-panel')

        <div class="user-content-area">
            @include('partials.user.header')

            <main class="user-main">
                {{ $slot }}
            </main>
        </div>

        <x-ui.bottom-nav />
    </div>

    @include('partials.user.membership-check-modal', ['hasMember' => auth()->user()->member !== null])

</body>
</html>