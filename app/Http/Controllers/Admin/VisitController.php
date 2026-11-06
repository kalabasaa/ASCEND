<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GymVisit;

class VisitController extends Controller
{
    public function index()
    {
        $visits = GymVisit::with('member')->latest('check_in')->paginate(10);

        return view('admin.visits.index', compact('visits'));
    }
}