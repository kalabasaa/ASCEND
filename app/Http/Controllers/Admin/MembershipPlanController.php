<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreMembershipPlanRequest;
use App\Http\Requests\Admin\UpdateMembershipPlanRequest;
use App\Models\MembershipPlan;
use App\Models\Trainer;

class MembershipPlanController extends Controller
{
    public function index()
    {
        // Eager-load trainer name for the plan card
        $plans = MembershipPlan::with('trainer')->paginate(10);

        return view('admin.plans.index', compact('plans'));
    }

    public function create()
    {
        $trainers = Trainer::where('status', 'active')->get();

        return view('admin.plans.create', compact('trainers'));
    }

    public function store(StoreMembershipPlanRequest $request)
    {
        MembershipPlan::create($request->validated());

        return redirect()->route('admin.plans.index')->with('success', 'Plan created.');
    }

    public function edit(MembershipPlan $plan)
    {
        $trainers = Trainer::where('status', 'active')->get();

        return view('admin.plans.edit', compact('plan', 'trainers'));
    }

    public function update(UpdateMembershipPlanRequest $request, MembershipPlan $plan)
    {
        $plan->update($request->validated());

        return redirect()->route('admin.plans.index')->with('success', 'Plan updated.');
    }

    public function destroy(MembershipPlan $plan)
    {
        $plan->delete();

        return redirect()->route('admin.plans.index')->with('success', 'Plan deleted.');
    }
}
