{{-- Place at: resources/views/auth/register.blade.php --}}
<x-layouts::auth :title="__('Sign up')">

    <x-slot:left>
        <span class="auth-badge">{{ __('Join the grind') }} </span>
        <h1 class="auth-hero__title font-display">
            {{ __('Start your streak today.') }}
        </h1>
        <p class="auth-hero__text">
            {{ __('Follow these simple steps to set up your account.') }}
        </p>
    </x-slot:left>

    <x-slot:steps>
        <div class="auth-step is-active">
            <span class="auth-step__num">1</span>
            <p>{{ __('Create your account') }}</p>
        </div>
        <div class="auth-step">
            <span class="auth-step__num">2</span>
            <p>{{ __('Build your profile with tags for what you train') }}</p>
        </div>
        <div class="auth-step">
            <span class="auth-step__num">3</span>
            <p>{{ __('Check in and start stacking your streak') }}</p>
        </div>
    </x-slot:steps>

    <h2 class="auth-title font-display">{{ __('Register') }}</h2>

    @if (session('status'))
        <div class="auth-status">{{ session('status') }}</div>
    @endif

    <form method="POST" action="{{ route('register') }}" class="auth-form-fields">
        @csrf

        {{-- Full name + Username --}}
        <div class="auth-row">
            <div>
                <label for="name" class="auth-label">{{ __('Full name') }}</label>
                <input
                    id="name"
                    name="name"
                    type="text"
                    value="{{ old('name') }}"
                    required
                    autofocus
                    autocomplete="name"
                    placeholder="{{ __('Juan Dela Cruz') }}"
                    class="auth-input"
                >
                @error('name')
                    <p class="auth-error">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="username" class="auth-label">{{ __('Username') }}</label>
                <input
                    id="username"
                    name="username"
                    type="text"
                    value="{{ old('username') }}"
                    required
                    autocomplete="username"
                    placeholder="{{ __('yourusername') }}"
                    class="auth-input"
                >
                @error('username')
                    <p class="auth-error">{{ $message }}</p>
                @enderror
            </div>
        </div>

        {{-- Email address --}}
        <div>
            <label for="email" class="auth-label">{{ __('Email address') }}</label>
            <input
                id="email"
                name="email"
                type="email"
                value="{{ old('email') }}"
                autocomplete="email"
                placeholder="email@example.com"
                class="auth-input"
            >
            @error('email')
                <p class="auth-error">{{ $message }}</p>
            @enderror
        </div>

        {{-- Password + Confirm password --}}
        <div>
            <div class="auth-row">
                <div>
                    <label for="password" class="auth-label">{{ __('Password') }}</label>
                    <div class="relative">
                        <input
                            id="password"
                            name="password"
                            type="password"
                            required
                            autocomplete="new-password"
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

                <div>
                    <label for="password_confirmation" class="auth-label">{{ __('Confirm password') }}</label>
                    <div class="relative">
                        <input
                            id="password_confirmation"
                            name="password_confirmation"
                            type="password"
                            required
                            autocomplete="new-password"
                            placeholder="{{ __('••••••••') }}"
                            class="auth-input auth-input--password"
                        >
                        <button
                            type="button"
                            class="auth-password-toggle"
                            data-toggle-password="password_confirmation"
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
                    @error('password_confirmation')
                        <p class="auth-error">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            <p class="auth-hint">{{ __('At least 12 characters, with uppercase, lowercase, numbers and symbols.') }}</p>
        </div>

        {{-- Terms and Conditions --}}
        <x-terms-checkbox />

        <button type="submit" class="auth-btn-primary">
            {{ __('Continue') }}
        </button>
    </form>

    <p class="auth-switch">
        {{ __('Already have an account?') }}
        <a href="{{ route('login') }}" class="auth-link">{{ __('Log in') }}</a>
    </p>

   

</x-layouts::auth>