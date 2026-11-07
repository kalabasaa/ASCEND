<x-layouts::admin title="Dashboard" page="dashboard">

    <x-layout.page-header title="Admin Dashboard" description="Overview of gym operations" />

    <div class="stat-grid">
        <x-ui.stat-card title="Total Users" :value="$stats['total_users'] ?? 0" />
        <x-ui.stat-card title="Total Members" :value="$stats['total_members'] ?? 0" />
        <x-ui.stat-card title="Active Subscriptions" :value="$stats['active_subscriptions'] ?? 0" />
        <x-ui.stat-card title="Total Trainers" :value="$stats['total_trainers'] ?? 0" />
        <x-ui.stat-card title="Total Products" :value="$stats['total_products'] ?? 0" />
        <x-ui.stat-card title="Today's Sales" :value="'₱' . number_format($stats['todays_sales'] ?? 0, 2)" />
    </div>

    <div class="admin-content-grid">

        <div class="admin-stack">
            <x-admin.bar-chart title="Sales overview" :data="$salesChart ?? []" />

            <x-ui.info-card title="Recent Transactions">
                @forelse (($recentTransactions ?? []) as $sale)
                    <div class="data-card-list">
                        <x-ui.data-card
                            title="{{ $sale->member->first_name ?? 'Walk-in' }} {{ $sale->member->last_name ?? '' }}"
                            subtitle="{{ $sale->sale_date->format('M d, Y g:i A') }}"
                            value="₱{{ number_format($sale->total_amount, 2) }}"
                        />
                    </div>
                @empty
                    <x-ui.empty-state title="No recent transactions" />
                @endforelse
            </x-ui.info-card>
        </div>

        <x-ui.info-card title="Recent Member Registrations">
            @forelse (($recentRegistrations ?? []) as $member)
                <x-ui.info-row label="{{ $member->first_name }} {{ $member->last_name }}">
                    {{ $member->member_id ?? '—' }}
                </x-ui.info-row>
            @empty
                <x-ui.empty-state title="No recent registrations" />
            @endforelse
        </x-ui.info-card>

    </div>

</x-layouts::admin>