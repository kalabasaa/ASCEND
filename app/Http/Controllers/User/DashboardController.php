<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $member = $user->member;

        return view('user.dashboard', [
            'member' => $member,
            'subscription' => $member?->subscriptions()->latest('end_date')->first(),
            'recentVisits' => $member?->gymVisits()->latest('check_in')->take(5)->get() ?? collect(),
            'recentPurchases' => $member?->sales()->with('soldProducts')->latest('sale_date')->take(5)->get() ?? collect(),
        ]);
    }
}
