{{-- Place at: resources/views/auth/login.blade.php --}}
<x-layouts::auth :title="__('Log in')">

    <x-slot:left>
        <span class="auth-badge">{{ __('Welcome back, athlete') }}</span>
        <h1 class="auth-hero__title font-display">
            {{ __('Every day you show up is a day you grow.') }}
        </h1>
        <p class="auth-hero__text">
            {{ __('Log back in and keep your streak alive — consistency is what separates progress from wishful thinking.') }}
        </p>
    </x-slot:left>

    <h2 class="auth-title font-display">{{ __('Login') }}</h2>
    <p class="auth-sub">{{ __('Enter your details to pick up where you left off.') }}</p>

    @if (session('status'))
        <div class="auth-status">{{ session('status') }}</div>
    @endif

    <form method="POST" action="{{ route('login') }}" class="auth-form-fields">
        @csrf

        {{-- Username --}}
        <div>
            <label for="username" class="auth-label">{{ __('Username') }}</label>
            <input
                id="username"
                name="username"
                type="text"
                value="{{ old('username') }}"
                required
                autofocus
                autocomplete="username"
                placeholder="{{ __('yourusername') }}"
                class="auth-input"
            >
            @error('username')
                <p class="auth-error">{{ $message }}</p>
            @enderror
        </div>

        {{-- Password --}}
        <div>
            <div class="auth-label-row">
                <label for="password" class="auth-label">{{ __('Password') }}</label>
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="text-xs auth-link">
                        {{ __('Forgot password?') }}
                    </a>
                @endif
            </div>
            <div class="relative">
                <input
                    id="password"
                    name="password"
                    type="password"
                    required
                    autocomplete="current-password"
                    placeholder="{{ __('••••••••') }}"
                    class="auth-input auth-input--password"
                >
                <button
                    type="button"
                    class="auth-password-toggle"
                    data-toggle-password="password"
                    data-show-label="{{ __('Show password') }}"
                    data-hide-label="{{ __('Hide password') }}"
                    aria-label="{{ __('Show password') }}"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                        <path d="M1 12s4-7 11-7 11 7 11 7-4 7-11 7-11-7-11-7Z"/>
                        <circle cx="12" cy="12" r="3"/>
                    </svg>
                </button>
            </div>
            @error('password')
                <p class="auth-error">{{ $message }}</p>
            @enderror
        </div>

        {{-- Remember me --}}
        <label class="auth-remember">
            <input
                type="checkbox"
                name="remember"
                {{ old('remember') ? 'checked' : '' }}
                class="auth-checkbox"
            >
            {{ __('Remember me') }}
        </label>

        <button type="submit" class="auth-btn-primary">
            {{ __('Log in') }}
        </button>
    </form>

    <p class="auth-switch">
        {{ __("Don't have an account?") }}
        <a href="{{ route('register') }}" class="auth-link">{{ __('Sign up') }}</a>
    </p>

   

</x-layouts::auth>