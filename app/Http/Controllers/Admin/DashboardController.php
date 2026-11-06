<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Member;
use App\Models\Product;
use App\Models\Sale;

class DashboardController extends Controller
{
    public function index()
    {
        // Core stats for dashboard cards
        $totalMembers = Member::count();
        $activeSubscriptions = Member::whereHas('subscriptions', fn ($q) => $q->where('status', 'active'))->count();
        $totalSales = Sale::sum('total_amount');
        $lowStockProducts = Product::whereColumn('stock_quantity', '<=', 'low_stock_threshold')->count();

        return view('admin.dashboard.index', compact(
            'totalMembers',
            'activeSubscriptions',
            'totalSales',
            'lowStockProducts'
        ));
    }
}