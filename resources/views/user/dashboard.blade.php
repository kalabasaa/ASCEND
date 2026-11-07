<x-layouts::user title="Dashboard">

    <x-layout.page-header title="Your Dashboard" description="Here's what's happening with your account." />

    @if ($member)

        <div class="stat-grid">
            <x-ui.stat-card
                title="Membership"
                :value="$subscription?->membershipPlan->name ?? '—'"
            />
            <x-ui.stat-card
                title="Status"
                :value="$subscription?->status ?? 'none'"
            />
        </div>

        <x-ui.info-card title="Membership Details">
            <x-ui.info-row label="{{ __('Plan') }}">{{ $subscription?->membershipPlan->name ?? '—' }}</x-ui.info-row>
            <x-ui.info-row label="{{ __('Status') }}">
                @if ($subscription)
                    <x-ui.status-badge :status="$subscription->status" />
                @else
                    <x-ui.status-badge status="inactive" />
                @endif
            </x-ui.info-row>
            @if ($subscription?->end_date)
                <x-ui.info-row label="{{ __('Expires') }}">{{ $subscription->end_date->format('M d, Y') }}</x-ui.info-row>
            @endif
        </x-ui.info-card>

        <x-ui.info-card title="Recent Visits">
            @forelse ($recentVisits as $visit)
                <div class="data-card-list">
                    <x-ui.data-card
                        title="{{ $visit->check_in->format('M d, Y') }}"
                        subtitle="{{ $visit->check_in->format('g:i A') }}"
                    />
                </div>
            @empty
                <x-ui.empty-state title="No visits yet" description="Check in at the front desk to start your streak." />
            @endforelse
        </x-ui.info-card>

        <x-ui.info-card title="Recent Purchases">
            @forelse ($recentPurchases as $sale)
                <div class="data-card-list">
                    <x-ui.data-card
                        title="{{ $sale->sale_date->format('M d, Y') }}"
                        subtitle="{{ $sale->soldProducts->count() }} {{ __('item(s)') }}"
                        value="₱{{ number_format($sale->total_amount, 2) }}"
                    />
                </div>
            @empty
                <x-ui.empty-state title="No purchases yet" />
            @endforelse
        </x-ui.info-card>

    @else

        <x-ui.empty-state
            title="No membership linked yet"
            description="Once you have a membership at Ascend, an administrator will link it to your account."
        />

    @endif

</x-layouts::user>