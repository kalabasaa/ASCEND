<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreSubscriptionRequest;
use App\Models\MemberSubscription;

class SubscriptionController extends Controller
{
    public function store(StoreSubscriptionRequest $request)
    {
        MemberSubscription::create($request->validated());

        return back()->with('success', 'Subscription added.');
    }
}