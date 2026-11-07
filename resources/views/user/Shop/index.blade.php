<x-layouts::user title="Shop">

    <x-layout.page-header title="Shop" description="Browse available products." />

    <div style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 0.75rem;">
        @forelse ($products as $product)
            <x-ui.product-card :product="$product" />
        @empty
            <div style="grid-column: 1 / -1;">
                <x-ui.empty-state title="No products available right now" />
            </div>
        @endforelse
    </div>

    @if ($products->hasPages())
        <div class="mt-4">{{ $products->links() }}</div>
    @endif

</x-layouts::user>