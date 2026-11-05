{{-- Place at: resources/views/auth/reset-password.blade.php --}}
<x-layouts::auth :title="__('Reset password')">

    <x-slot:left>
        <span class="auth-badge">{{ __('Almost there') }} 💪</span>
        <h1 class="auth-hero__title font-display">
            {{ __('Pick a new password and keep your streak going.') }}
        </h1>
    </x-slot:left>

    <h2 class="auth-title font-display">{{ __('Reset password') }}</h2>
    <p class="auth-sub">{{ __('Please enter your new password below.') }}</p>

    @if (session('status'))
        <div class="auth-status">{{ session('status') }}</div>
    @endif

    <form method="POST" action="{{ route('password.update') }}" class="auth-form-fields">
        @csrf
        <input type="hidden" name="token" value="{{ request()->route('token') }}">

        {{-- Email --}}
        <div>
            <label for="email" class="auth-label">{{ __('Email') }}</label>
            <input
                id="email"
                name="email"
                type="email"
                value="{{ old('email', request('email')) }}"
                required
                autocomplete="email"
                class="auth-input"
            >
            @error('email')
                <p class="auth-error">{{ $message }}</p>
            @enderror
        </div>

        {{-- Password --}}
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
                    passwordrules="{{ \Illuminate\Validation\Rules\Password::defaults()->toPasswordRulesString() }}"
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

        {{-- Confirm password --}}
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
                    passwordrules="{{ \Illuminate\Validation\Rules\Password::defaults()->toPasswordRulesString() }}"
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

        <button type="submit" class="auth-btn-primary" data-test="reset-password-button">
            {{ __('Reset password') }}
        </button>
    </form>

</x-layouts::auth>