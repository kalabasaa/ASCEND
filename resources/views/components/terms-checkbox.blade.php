{{--
    Place at: resources/views/components/terms-checkbox.blade.php
    Usage (inside the register form, before the submit button):

        <x-terms-checkbox />

    Expects the controller to validate: 'terms' => ['required', 'accepted']
--}}

<div>
    <div class="auth-terms-row">
        <input
            id="terms"
            name="terms"
            type="checkbox"
            required
            class="auth-checkbox"
            {{ old('terms') ? 'checked' : '' }}
        >
        <label for="terms">
            {{ __('I agree to Ascend\'s') }}
            <a href="{{ route('terms') }}" target="_blank" rel="noopener" class="auth-link">{{ __('Terms and Conditions') }}</a>
        </label>
    </div>
    @error('terms')
        <p class="auth-error">{{ $message }}</p>
    @enderror
</div>