<?php

namespace App\Http\Controllers;

use App\Models\Goal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GoalController extends Controller
{
    public function index()
    {
        $goals = Goal::where('user_id', 1)->get();
        return view('goals.index', compact('goals'));
    }

    public function create()
    {
        return view('goals.create');
    }

    public function dashboard()
    {
        return view('dashboard');
    }

    public function store(Request $request)
    {
        $request->validate([
            'target_hours' => 'required|integer',
        ]);

        Goal::create([
            //'user_id' => Auth::id(),
            'user_id' => 1,
            'target_hours' => $request->target_hours,
        ]);

        return redirect()->route('goals.index')->with('success', 'Goal created successfully!');
    }

    public function edit(Goal $goal)
    {
        return view('goals.edit', compact('goal'));
    }

    public function update(Request $request, Goal $goal)
    {
        $request->validate([
            'actual_hours' => 'required|integer',
        ]);

        $goal->actual_hours = $request->actual_hours;
        $goal->met = $goal->actual_hours >= $goal->target_hours;
        $goal->save();

        return redirect()->route('goals.index')->with('success', 'Goal updated successfully!');
    }

    public function destroy(Goal $goal)
    {
        $goal->forceDelete(); // Permanently deletes the record
        return redirect()->route('goals.index')->with('success', 'Goal deleted successfully!');
    }
}