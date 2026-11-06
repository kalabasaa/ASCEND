<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Member;
use App\Models\MemberSubscription;
use App\Models\Product;
use App\Models\Sale;
use App\Models\Trainer;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        return view('admin.dashboard', [
            'stats' => [
                'total_users' => User::count(),
                'total_members' => Member::count(),
                'active_subscriptions' => MemberSubscription::where('status', 'active')->count(),
                'total_trainers' => Trainer::count(),
                'total_products' => Product::count(),
                'todays_sales' => Sale::whereDate('sale_date', today())->sum('total_amount'),
            ],
            'recentTransactions' => Sale::with(['member', 'user'])->latest('sale_date')->take(5)->get(),
            'recentRegistrations' => Member::latest()->take(5)->get(),
        ]);
    }
}