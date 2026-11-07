<header class="admin-topbar">
    <div class="admin-topbar__left">
        <button type="button" class="admin-topbar__menu-btn" data-sidebar-toggle aria-controls="admin-sidebar" aria-expanded="false" aria-label="{{ __('Open menu') }}">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" class="w-5 h-5">
                <path d="M4 6h16M4 12h16M4 18h16"/>
            </svg>
        </button>
        <span class="admin-topbar__title">{{ $title ?? __('Admin') }}</span>
    </div>

    <div class="admin-topbar__right">
        @if ($activity)
            <button type="button" class="btn btn--ghost btn--sm" data-activity-toggle aria-controls="activity-panel" aria-expanded="false">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4">
                    <rect x="3" y="4" width="18" height="16" rx="2"/><path d="M15 4v16"/>
                </svg>
                <span class="hide-sm">{{ __('Activity') }}</span>
            </button>
        @endif

        <span class="admin-topbar__user">{{ auth()->user()->username }}</span>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="btn btn--ghost btn--sm">{{ __('Log out') }}</button>
        </form>
    </div>
</header>