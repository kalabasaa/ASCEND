<x-layouts::user title="Membership">

    <x-layout.page-header title="Membership" description="Your subscription history and available plans." />

    @if ($member)
        <x-ui.info-card title="Your Membership Code">
            <input type="text" readonly value="{{ $member->member_id }}"
                   onclick="this.select()"
                   class="member-code-input">
            <p style="font-size: 0.75rem; color: var(--ink-soft); margin-top: 0.5rem; text-align: center;">{{ __('Show this to staff at the front desk when needed.') }}</p>
        </x-ui.info-card>

        <x-ui.info-card title="Current Subscription">
            @if ($subscriptions->isNotEmpty())
                @php $current = $subscriptions->first(); @endphp
                <x-ui.info-row label="{{ __('Plan') }}">{{ $current->membershipPlan->name }}</x-ui.info-row>
                <x-ui.info-row label="{{ __('Status') }}">
                    <x-ui.status-badge :status="$current->status" />
                </x-ui.info-row>
                <x-ui.info-row label="{{ __('Start') }}">{{ $current->start_date->format('M d, Y') }}</x-ui.info-row>
                <x-ui.info-row label="{{ __('Expires') }}">{{ $current->end_date->format('M d, Y') }}</x-ui.info-row>
            @else
                <x-ui.empty-state title="No active subscription" description="Browse plans below to get started." />
            @endif
        </x-ui.info-card>

        @if ($subscriptions->count() > 1)
            <x-ui.info-card title="Subscription History">
                <div class="data-card-list">
                    @foreach ($subscriptions->skip(1) as $sub)
                        <x-ui.data-card
                            title="{{ $sub->membershipPlan->name }}"
                            subtitle="{{ $sub->start_date->format('M d, Y') }} – {{ $sub->end_date->format('M d, Y') }}"
                            value="₱{{ number_format($sub->amount, 2) }}"
                        />
                    @endforeach
                </div>
            </x-ui.info-card>
        @endif
    @else
        <x-ui.empty-state
            title="No membership linked yet"
            description="Once you have a membership at Ascend, an administrator will link it to your account."
        />
    @endif

    <x-ui.info-card title="Available Plans">
        <div class="data-card-list">
            @forelse ($plans as $plan)
                <x-ui.data-card
                    title="{{ $plan->name }}"
                    subtitle="{{ $plan->duration_days }} {{ __('days') }}"
                    value="₱{{ number_format($plan->price, 2) }}"
                />
            @empty
                <x-ui.empty-state title="No plans available right now" />
            @endforelse
        </div>
    </x-ui.info-card>

</x-layouts::user>