<header class="user-topbar">
    <div class="user-topbar__greeting">
        <div class="user-topbar__hello">{{ __('Welcome back') }}</div>
        <div class="user-topbar__name">{{ auth()->user()->username }}</div>
    </div>



    <div class="flex items-center gap-3">
       

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="text-sm font-medium underline">{{ __('Log out') }}</button>
        </form>
    </div>
</header>