<x-layouts::user title="Edit Profile">

    <x-layout.page-header title="Edit Profile" description="Update your account information." />

    <div style="display: flex; flex-direction: column; align-items: center; margin-bottom: 1.25rem;">
        <x-ui.avatar :path="null" size="lg" />
        <div style="font-weight: 700; font-size: 1.0625rem; margin-top: 0.625rem;">{{ $user->username }}</div>
    </div>

    <x-ui.info-card title="Account">
        <form method="POST" action="{{ route('user.profile.update') }}" style="display: flex; flex-direction: column; gap: 1rem;">
            @csrf
            @method('PATCH')

            <div>
                <label for="username" style="font-size: 0.75rem; font-weight: 600; color: var(--ink-soft);">{{ __('Username') }}</label>
                <input id="username" name="username" type="text" value="{{ old('username', $user->username) }}"
                       style="width: 100%; padding: 0.625rem; border-radius: 0.5rem; border: 1px solid var(--hairline); background: var(--field-bg); margin-top: 0.25rem;">
                @error('username')
                    <p style="color: var(--danger-text); font-size: 0.75rem; margin-top: 0.25rem;">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="email" style="font-size: 0.75rem; font-weight: 600; color: var(--ink-soft);">{{ __('Email') }}</label>
                <input id="email" name="email" type="email" value="{{ old('email', $user->email) }}"
                       style="width: 100%; padding: 0.625rem; border-radius: 0.5rem; border: 1px solid var(--hairline); background: var(--field-bg); margin-top: 0.25rem;">
                @error('email')
                    <p style="color: var(--danger-text); font-size: 0.75rem; margin-top: 0.25rem;">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit" class="modal-btn modal-btn--primary">{{ __('Save Changes') }}</button>

            @if (session('status') === 'profile-updated')
                <p style="color: var(--success-text); font-size: 0.8125rem;">{{ __('Profile updated.') }}</p>
            @endif
        </form>
    </x-ui.info-card>

</x-layouts::user>