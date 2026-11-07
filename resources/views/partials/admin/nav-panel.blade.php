@php
    $groups = [
        'Overview' => [
            ['key' => 'dashboard', 'label' => 'Dashboard', 'route' => 'admin.dashboard', 'icon' => '<rect x="3" y="3" width="7" height="9" rx="1"/><rect x="14" y="3" width="7" height="5" rx="1"/><rect x="14" y="12" width="7" height="9" rx="1"/><rect x="3" y="16" width="7" height="5" rx="1"/>'],
        ],
        'People' => [
            ['key' => 'users', 'label' => 'Users', 'route' => 'admin.users.index', 'icon' => '<circle cx="9" cy="8" r="3.5"/><path d="M2.5 20c.8-3.3 3.4-5 6.5-5s5.7 1.7 6.5 5"/><path d="M16 4.5a3.5 3.5 0 0 1 0 7M18 15.5c2 .6 3.2 2 3.5 4.5"/>'],
            ['key' => 'members', 'label' => 'Members', 'route' => 'admin.members.index', 'icon' => '<rect x="3" y="5" width="18" height="14" rx="2"/><circle cx="9" cy="11" r="2.5"/><path d="M5.5 16c.6-1.6 1.9-2.5 3.5-2.5s2.9.9 3.5 2.5M15 10h3M15 13h3"/>'],
            ['key' => 'trainers', 'label' => 'Trainers', 'route' => 'admin.trainers.index', 'icon' => '<path d="M6 8v8M3.5 10v4M18 8v8M20.5 10v4M6 12h12"/>'],
        ],
        'Memberships' => [
            ['key' => 'plans', 'label' => 'Membership Plans', 'route' => 'admin.plans.index', 'icon' => '<path d="m4 7 8-4 8 4-8 4-8-4Z"/><path d="m4 12 8 4 8-4M4 17l8 4 8-4"/>'],
          
            ['key' => 'payments', 'label' => 'Payments', 'route' => 'admin.payments.index', 'icon' => '<rect x="3" y="6" width="18" height="12" rx="2"/><path d="M3 10h18M7 15h3"/>'],
        ],
        'Shop' => [
            ['key' => 'products', 'label' => 'Products', 'route' => 'admin.products.index', 'icon' => '<path d="M3.5 8 12 4l8.5 4v8L12 20l-8.5-4V8Z"/><path d="m3.5 8 8.5 4 8.5-4M12 12v8"/>'],
            ['key' => 'sales', 'label' => 'Sales', 'route' => 'admin.sales.index', 'icon' => '<path d="M6 3h12v18l-3-2-3 2-3-2-3 2V3Z"/><path d="M9 8h6M9 12h6"/>'],
        ],
        'Gym' => [
            ['key' => 'visits', 'label' => 'Visits', 'route' => 'admin.visits.index', 'icon' => '<circle cx="12" cy="12" r="9"/><path d="m8.5 12.5 2.5 2.5 4.5-5"/>'],
        ],
    ];
@endphp

<div class="admin-sidebar__logo">
    <img src="{{ asset('assets/logo/ascend-wt2.png') }}" alt="Ascend" class="h-7 w-auto">
    <button type="button" class="admin-sidebar__close" data-sidebar-close aria-label="{{ __('Close menu') }}">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><path d="M6 6l12 12M18 6 6 18"/></svg>
    </button>
</div>

<nav class="admin-nav" aria-label="{{ __('Admin sections') }}">
    @foreach ($groups as $group => $links)
        <div class="admin-nav-section">{{ $group }}</div>

        @foreach ($links as $link)
            @php
                $exists = Route::has($link['route']);
                $active = ($page ?? null) === $link['key'];
            @endphp

            @if ($exists)
                <a href="{{ route($link['route']) }}" class="admin-nav-link {{ $active ? 'is-active' : '' }}" @if ($active) aria-current="page" @endif>
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">{!! $link['icon'] !!}</svg>
                    <span>{{ $link['label'] }}</span>
                </a>
            @else
                <span class="admin-nav-link is-disabled" aria-disabled="true">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">{!! $link['icon'] !!}</svg>
                    <span>{{ $link['label'] }}</span>
                    <span class="admin-nav-link__soon">{{ __('Soon') }}</span>
                </span>
            @endif
        @endforeach
    @endforeach
</nav>