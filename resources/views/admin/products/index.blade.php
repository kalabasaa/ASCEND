@php
    $paginator = $products ?? null;
    $records = collect($paginator?->items() ?? [])->map(fn ($product) => [
        'id' => $product->id,
        'name' => $product->name,
        'description' => $product->description,
        'category' => $product->category,
        'price' => $product->price,
        'price_label' => '₱'.number_format($product->price, 2),
        'stock_quantity' => $product->stock_quantity,
        'low_stock_threshold' => $product->low_stock_threshold,
        'stock_state' => $product->stock_quantity <= 0 ? 'out of stock' : ($product->stock_quantity <= $product->low_stock_threshold ? 'low stock' : 'in stock'),
        'status' => $product->status,
    ])->values()->all();
@endphp

<x-layouts::admin title="Products" page="products" :activity="true">
    <x-admin.resource
        title="Products"
        description="Shop inventory, stock levels and availability."
        noun="product"
        :records="$records"
        :paginator="$paginator"
        :columns="['name' => 'Product', 'category' => 'Category', 'price_label' => 'Price', 'stock_quantity' => 'Stock', 'stock_state' => 'Stock level', 'status' => 'Status']"
        :badges="['stock_state', 'status']"
        filter-key="stock_state"
        :details="['name' => 'Product', 'description' => 'Description', 'category' => 'Category', 'price_label' => 'Price', 'stock_quantity' => 'In stock', 'low_stock_threshold' => 'Low-stock threshold', 'status' => 'Status']"
        store="admin.products.store"
        update="admin.products.update"
        destroy="admin.products.destroy"
        param="product"
    >
        <x-slot:fields>
            <x-field name="name" label="Product name" required />
            <x-field name="description" label="Description" type="textarea" />
            <x-field name="category" label="Category" />
            <x-field name="price" label="Price (₱)" type="number" min="0" step="0.01" required />
            <x-field name="stock_quantity" label="Stock quantity" type="number" min="0" default="0" required />
            <x-field name="low_stock_threshold" label="Low-stock threshold" type="number" min="0" default="5" required />
            <x-field name="status" label="Status" type="select" :options="['active' => 'Active', 'inactive' => 'Inactive']" default="active" required />
        </x-slot:fields>
    </x-admin.resource>
</x-layouts::admin>