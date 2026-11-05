{{-- Place at: resources/views/auth/forgot-password.blade.php --}}
<x-layouts::auth :title="__('Forgot password')">

    <x-slot:left>
        <span class="auth-badge">{{ __('No stress') }} 💪</span>
        <h1 class="auth-hero__title font-display">
            {{ __('Locked out? Back to training in a minute.') }}
        </h1>
        <p class="auth-hero__text">
            {{ __('We will email you a link to set a new password.') }}
        </p>
    </x-slot:left>

    <h2 class="auth-title font-display">{{ __('Forgot password') }}</h2>
    <p class="auth-sub">{{ __('Enter your email to receive a password reset link.') }}</p>

    @if (session('status'))
        <div class="auth-status">{{ session('status') }}</div>
    @endif

    <form method="POST" action="{{ route('password.email') }}" class="auth-form-fields">
        @csrf

        <div>
            <label for="email" class="auth-label">{{ __('Email address') }}</label>
            <input
                id="email"
                name="email"
                type="email"
                value="{{ old('email') }}"
                required
                autofocus
                autocomplete="email"
                placeholder="email@example.com"
                class="auth-input"
            >
            @error('email')
                <p class="auth-error">{{ $message }}</p>
            @enderror
        </div>

        <button type="submit" class="auth-btn-primary" data-test="email-password-reset-link-button">
            {{ __('Email password reset link') }}
        </button>
    </form>

    <p class="auth-switch">
        {{ __('Or, return to') }}
        <a href="{{ route('login') }}" class="auth-link">{{ __('log in') }}</a>
    </p>

</x-layouts::auth>