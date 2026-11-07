@props(['product'])

@php
    $lowStock = $product->stock_quantity <= $product->low_stock_threshold;
    $outOfStock = $product->stock_quantity <= 0;
@endphp

<a href="{{ route('user.shop.show', $product) }}" style="text-decoration: none; color: inherit;">
    <div style="background: var(--white); border: 1px solid var(--hairline); border-radius: 1rem; overflow: hidden;">
        <div style="aspect-ratio: 1 / 1; background: var(--field-bg); display: flex; align-items: center; justify-content: center;">
            <svg width="2rem" height="2rem" viewBox="0 0 24 24" fill="none" stroke="var(--ink-soft)" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" style="opacity: 0.5;">
                <rect x="3" y="3" width="18" height="18" rx="2"/>
                <circle cx="9" cy="9" r="2"/>
                <path d="m21 15-5-5L5 21"/>
            </svg>
        </div>
        <div style="padding: 0.75rem;">
            <div class="data-card__title">{{ $product->name }}</div>
            <div class="data-card__sub" style="margin-bottom: 0.5rem;">{{ $product->category ?? __('Uncategorized') }}</div>
            <div style="display: flex; align-items: center; justify-content: space-between;">
                <div class="data-card__value">₱{{ number_format($product->price, 2) }}</div>
                <x-ui.status-badge :status="$outOfStock ? 'out of stock' : ($lowStock ? 'low stock' : 'in stock')" />
            </div>
        </div>
    </div>
</a>