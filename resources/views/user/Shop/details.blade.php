<x-layouts::user title="{{ $product->name }}">

    <x-layout.page-header :title="$product->name" :description="$product->category ?? __('Uncategorized')" />

    <x-ui.info-card title="Details">
        <x-ui.info-row label="{{ __('Price') }}">₱{{ number_format($product->price, 2) }}</x-ui.info-row>
        <x-ui.info-row label="{{ __('Stock') }}">{{ $product->stock_quantity }}</x-ui.info-row>
        <x-ui.info-row label="{{ __('Status') }}">
            <x-ui.status-badge :status="$product->stock_quantity <= 0 ? 'out of stock' : ($product->stock_quantity <= $product->low_stock_threshold ? 'low stock' : 'in stock')" />
        </x-ui.info-row>
    </x-ui.info-card>

    @if ($product->description)
        <x-ui.info-card title="Description">
            <p style="font-size: 0.8125rem; color: var(--ink-soft);">{{ $product->description }}</p>
        </x-ui.info-card>
    @endif

    {{-- Purchase handled at checkout/staff side per schema — no buy action here --}}

</x-layouts::user>