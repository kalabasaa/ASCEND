@php
    $paginator = $payments ?? null;
    $records = collect($paginator?->items() ?? [])->map(function ($payment) {
        $owner = $payment->subscription?->member ?? $payment->sale?->member;

        return [
            'id' => $payment->id,
            'payer' => $owner ? $owner->first_name.' '.$owner->last_name : 'Walk-in',
            'type' => ucfirst($payment->payment_type),
            'amount_label' => '₱'.number_format($payment->amount, 2),
            'payment_method' => ucfirst($payment->payment_method),
            'payment_date' => $payment->payment_date?->format('M d, Y'),
            'reference_number' => $payment->reference_number,
        ];
    })->values()->all();
@endphp

<x-layouts::admin title="Payments" page="payments" :activity="true">
    <x-admin.resource
        title="Payments"
        description="Recorded membership and product payments."
        noun="payment"
        :records="$records"
        :paginator="$paginator"
        :columns="['payment_date' => 'Date', 'payer' => 'Payer', 'type' => 'Type', 'amount_label' => 'Amount', 'payment_method' => 'Method']"
        filter-key="type"
        :details="['payer' => 'Payer', 'type' => 'Type', 'amount_label' => 'Amount', 'payment_method' => 'Method', 'payment_date' => 'Date', 'reference_number' => 'Reference']"
        store="admin.payments.store"
        param="payment"
    >
        <x-slot:fields>
            <x-field name="payment_type" label="Payment for" type="select" :options="['subscription' => 'Membership subscription', 'sale' => 'Product sale']" required />
            <x-field name="subscription_id" label="Subscription ID" type="number" min="1" hint="Required for membership payments." />
            <x-field name="sale_id" label="Sale ID" type="number" min="1" hint="Required for product payments." />
            <x-field name="amount" label="Amount (₱)" type="number" min="0" step="0.01" required />
            <x-field name="payment_method" label="Method" type="select" :options="['cash' => 'Cash', 'card' => 'Card', 'gcash' => 'GCash', 'bank transfer' => 'Bank transfer']" required />
            <x-field name="payment_date" label="Payment date" type="date" required />
            <x-field name="reference_number" label="Reference number" />
        </x-slot:fields>
    </x-admin.resource>
</x-layouts::admin>