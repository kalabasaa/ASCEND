<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\MembershipPlan;

class MembershipController extends Controller
{
    public function index()
    {
        $member = auth()->user()->member;

        $subscriptions = $member?->subscriptions()->with('membershipPlan')->latest('end_date')->get() ?? collect();
        $plans = MembershipPlan::where('status', 'active')->get();

        return view('user.membership.index', compact('member', 'subscriptions', 'plans'));
    }
}
