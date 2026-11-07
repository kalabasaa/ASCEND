@php
    $paginator = $subscriptions ?? null;
    $memberOptions = collect($members ?? [])->mapWithKeys(fn ($member) => [$member->id => $member->first_name.' '.$member->last_name])->all();
    $planOptions = collect($plans ?? [])->mapWithKeys(fn ($plan) => [$plan->id => $plan->name])->all();
    $records = collect($paginator?->items() ?? [])->map(fn ($subscription) => [
        'id' => $subscription->id,
        'member' => $subscription->member ? $subscription->member->first_name.' '.$subscription->member->last_name : 'Unknown',
        'plan' => $subscription->membershipPlan?->name ?? 'Unknown',
        'start_date' => $subscription->start_date?->format('M d, Y'),
        'end_date' => $subscription->end_date?->format('M d, Y'),
        'amount_label' => '₱'.number_format($subscription->amount, 2),
        'status' => $subscription->status,
    ])->values()->all();
@endphp

<x-layouts::admin title="Subscriptions" page="subscriptions" :activity="true">
    <x-admin.resource
        title="Subscriptions"
        description="Membership subscriptions and their status."
        noun="subscription"
        :records="$records"
        :paginator="$paginator"
        :columns="['member' => 'Member', 'plan' => 'Plan', 'end_date' => 'Expires', 'amount_label' => 'Amount', 'status' => 'Status']"
        :badges="['status']"
        filter-key="status"
        :details="['member' => 'Member', 'plan' => 'Plan', 'start_date' => 'Starts', 'end_date' => 'Expires', 'amount_label' => 'Amount', 'status' => 'Status']"
        store="admin.subscriptions.store"
        param="subscription"
    >
        <x-slot:fields>
            <x-admin.field name="member_id" label="Member" type="relation" :options="$memberOptions" required />
            <x-admin.field name="membership_plan_id" label="Plan" type="relation" :options="$planOptions" required />
            <x-admin.field name="start_date" label="Start date" type="date" required />
            <x-admin.field name="end_date" label="End date" type="date" required />
            <x-admin.field name="amount" label="Amount (₱)" type="number" min="0" step="0.01" required />
            <x-admin.field name="status" label="Status" type="select" :options="['active' => 'Active', 'expired' => 'Expired', 'cancelled' => 'Cancelled']" default="active" required />
        </x-slot:fields>
    </x-admin.resource>
</x-layouts::admin>