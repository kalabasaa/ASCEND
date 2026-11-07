<main class="admin-main" id="main">
    @if (session('success'))
        <div class="flash flash--success" role="status">
            <span>{{ session('success') }}</span>
            <button type="button" class="flash__close" data-dismiss aria-label="{{ __('Dismiss') }}">&times;</button>
        </div>
    @endif

    @if (session('error'))
        <div class="flash flash--error" role="alert">
            <span>{{ session('error') }}</span>
            <button type="button" class="flash__close" data-dismiss aria-label="{{ __('Dismiss') }}">&times;</button>
        </div>
    @endif

    @if ($errors->any() && ! old('_activity'))
        <div class="flash flash--error" role="alert">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{ $slot }}
</main>