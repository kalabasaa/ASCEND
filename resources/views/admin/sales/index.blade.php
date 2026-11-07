@php
    $paginator = $sales ?? null;
    $memberOptions = collect($members ?? [])->mapWithKeys(fn ($member) => [$member->id => $member->first_name.' '.$member->last_name])->all();
    $productOptions = collect($products ?? [])->mapWithKeys(fn ($product) => [$product->id => $product->name])->all();
    $records = collect($paginator?->items() ?? [])->map(fn ($sale) => [
        'id' => $sale->id,
        'date' => $sale->sale_date?->format('M d, Y g:i A'),
        'customer' => $sale->member ? $sale->member->first_name.' '.$sale->member->last_name : 'Walk-in',
        'recorded_by' => $sale->user?->username,
        'total_label' => '₱'.number_format($sale->total_amount, 2),
        'status' => $sale->status,
    ])->values()->all();
@endphp

<x-layouts::admin title="Sales" page="sales" :activity="true">
    <x-admin.resource
        title="Sales"
        description="Product sales and transaction details."
        noun="sale"
        :records="$records"
        :paginator="$paginator"
        :columns="['date' => 'Date', 'customer' => 'Customer', 'recorded_by' => 'Recorded by', 'total_label' => 'Total', 'status' => 'Status']"
        :badges="['status']"
        filter-key="status"
        :details="['date' => 'Date', 'customer' => 'Customer', 'recorded_by' => 'Recorded by', 'total_label' => 'Total', 'status' => 'Status']"
        store="admin.sales.store"
        destroy="admin.sales.destroy"
        param="sale"
    >
        <x-slot:fields>
            <x-field name="member_id" label="Member" type="relation" :options="$memberOptions" hint="Leave empty for a walk-in sale." />
            <x-field name="products[0][product_id]" label="Product" type="relation" :options="$productOptions" required />
            <x-field name="products[0][quantity]" label="Quantity" type="number" min="1" default="1" hint="The total is calculated by the server." required />
        </x-slot:fields>
    </x-admin.resource>
</x-layouts::admin>