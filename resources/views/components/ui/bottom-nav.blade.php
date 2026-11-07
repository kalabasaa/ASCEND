@php
    $items = [
        ['label' => 'Dashboard', 'route' => 'user.dashboard', 'icon' => 'home'],
        ['label' => 'Membership', 'route' => 'user.membership', 'icon' => 'card'],
        ['label' => 'Visits', 'route' => 'user.visits', 'icon' => 'check'],
        ['label' => 'Shop', 'route' => 'user.shop.index', 'icon' => 'bag'],
        ['label' => 'Profile', 'route' => 'user.profile.edit', 'icon' => 'user'],
    ];

    $icons = [
        'home' => '<path d="M4 11.5 12 5l8 6.5"/><path d="M6 10v9a1 1 0 0 0 1 1h3v-5h4v5h3a1 1 0 0 0 1-1v-9"/>',
        'card' => '<rect x="3" y="6" width="18" height="12" rx="2"/><path d="M3 10h18"/>',
        'check' => '<circle cx="12" cy="12" r="9"/><path d="m8.5 12.5 2.5 2.5 4.5-5"/>',
        'bag' => '<path d="M6 8h12l-1 12H7L6 8Z"/><path d="M9 8V6a3 3 0 0 1 6 0v2"/>',
        'user' => '<circle cx="12" cy="8" r="3.5"/><path d="M5 20c1.2-3.5 4-5 7-5s5.8 1.5 7 5"/>',
    ];
@endphp

<nav class="user-bottom-nav">
    @foreach ($items as $item)
        @php $active = Route::has($item['route']) && request()->routeIs($item['route'].'*'); @endphp
        <a href="{{ Route::has($item['route']) ? route($item['route']) : '#' }}"
           class="user-bottom-nav__item {{ $active ? 'is-active' : '' }}">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                {!! $icons[$item['icon']] !!}
            </svg>
            <span>{{ __($item['label']) }}</span>
        </a>
    @endforeach
</nav>