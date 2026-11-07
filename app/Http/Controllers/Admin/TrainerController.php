<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreTrainerRequest;
use App\Http\Requests\Admin\UpdateTrainerRequest;
use App\Models\Trainer;

class TrainerController extends Controller
{
    public function index()
    {
        $trainers = Trainer::paginate(10);

        return view('admin.trainers.index', compact('trainers'));
    }

    public function create()
    {
        return view('admin.trainers.create');
    }

    public function store(StoreTrainerRequest $request)
    {
        Trainer::create($request->validated());

        return redirect()->route('admin.trainers.index')->with('success', 'Trainer added.');
    }

    public function edit(Trainer $trainer)
    {
        return view('admin.trainers.edit', compact('trainer'));
    }

    public function update(UpdateTrainerRequest $request, Trainer $trainer)
    {
        $trainer->update($request->validated());

        return redirect()->route('admin.trainers.index')->with('success', 'Trainer updated.');
    }

    public function destroy(Trainer $trainer)
    {
        $trainer->delete();

        return redirect()->route('admin.trainers.index')->with('success', 'Trainer deleted.');
    }
}
