<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\GymVisit;
use Illuminate\Database\QueryException;

class VisitController extends Controller
{
    public function index()
    {
        $member = auth()->user()->member;
        $visits = $member?->gymVisits()->latest('check_in')->paginate(15);

        return view('user.visits.index', compact('member', 'visits'));
    }

    public function store()
    {
        $member = auth()->user()->member;

        if (! $member) {
            return back()->with('error', 'No member profile linked to this account.');
        }

        try {
            GymVisit::create(['member_id' => $member->id, 'check_in' => now()]);
        } catch (QueryException $e) {
            return back()->with('error', 'Already checked in today.');
        }

        return back()->with('success', 'Checked in.');
    }
}
