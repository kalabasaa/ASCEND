<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreSaleRequest;
use App\Models\Product;
use App\Models\Sale;
use Illuminate\Support\Facades\DB;

class SaleController extends Controller
{
    public function index()
    {
        $sales = Sale::with(['member', 'user'])->latest('sale_date')->paginate(10);

        return view('admin.sales.index', compact('sales'));
    }

    public function create()
    {
        $products = Product::where('status', 'active')->get();

        return view('admin.sales.create', compact('products'));
    }

    public function store(StoreSaleRequest $request)
    {
        // Totals computed server-side, never trusted from the client
        DB::transaction(function () use ($request) {
            $sale = Sale::create([
                'member_id' => $request->member_id,
                'user_id' => auth()->id(),
                'sale_date' => now(),
                'total_amount' => 0,
                'status' => 'completed',
            ]);

            $total = 0;

            foreach ($request->products as $item) {
                $product = Product::findOrFail($item['product_id']);
                $subtotal = $product->price * $item['quantity'];
                $total += $subtotal;

                $sale->soldProducts()->create([
                    'product_id' => $product->id,
                    'quantity' => $item['quantity'],
                    'unit_price' => $product->price,
                    'subtotal' => $subtotal,
                ]);

                $product->decrement('stock_quantity', $item['quantity']);
            }

            $sale->update(['total_amount' => $total]);
        });

        return redirect()->route('admin.sales.index')->with('success', 'Sale recorded.');
    }

    public function destroy(Sale $sale)
    {
        $sale->delete();

        return redirect()->route('admin.sales.index')->with('success', 'Sale deleted.');
    }
}