<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Product;

class ShopController extends Controller
{
    public function index()
    {
        $products = Product::where('status', 'active')->paginate(10);

        return view('user.shop.index', compact('products'));
    }

    public function show(Product $product)
    {
        return view('user.shop.show', compact('product'));
    }
}
