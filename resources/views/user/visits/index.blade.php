<x-layouts::user title="Visits">

    <x-layout.page-header title="Visit History" description="Your gym check-ins." />

    @if (! $member)
        <x-ui.empty-state
            title="No membership linked yet"
            description="Visit history will appear here once your account is linked to a membership."
        />
    @else
        @php
            $checkedInToday = $member->gymVisits()->whereDate('check_in', today())->exists();
        @endphp

        <form method="POST" action="{{ route('user.visits.store') }}" style="margin-bottom: 1rem;">
            @csrf
            <button type="submit" class="checkin-btn" {{ $checkedInToday ? 'disabled' : '' }}>
                <svg width="1.125rem" height="1.125rem" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="12" cy="12" r="9"/><path d="m8.5 12.5 2.5 2.5 4.5-5"/>
                </svg>
                {{ $checkedInToday ? __('Already checked in today') : __('Check In') }}
            </button>
        </form>

        @if (session('success'))
            <p style="color: var(--success-text); font-size: 0.8125rem; margin-bottom: 0.75rem;">{{ session('success') }}</p>
        @endif
        @if (session('error'))
            <p style="color: var(--danger-text); font-size: 0.8125rem; margin-bottom: 0.75rem;">{{ session('error') }}</p>
        @endif

        <x-ui.info-card title="Recent Check-ins">
            <div class="data-card-list">
                @forelse ($visits as $visit)
                    <x-ui.data-card
                        title="{{ $visit->check_in->format('M d, Y') }}"
                        subtitle="{{ $visit->check_in->format('g:i A') }}"
                    />
                @empty
                    <x-ui.empty-state title="No visits yet" description="Check in to start your streak." />
                @endforelse
            </div>
        </x-ui.info-card>

        @if ($visits instanceof \Illuminate\Pagination\LengthAwarePaginator && $visits->hasPages())
            <div class="mt-4">{{ $visits->links() }}</div>
        @endif
    @endif

</x-layouts::user>