<?php

namespace App\Http\Controllers;

use Carbon\Carbon; // Make sure to include this for date manipulation
use App\Models\Goal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Ride; // Ensure this line is added to import the Ride model

class GoalController extends Controller
{
    public function index()
    {
        $goals = Goal::where('user_id', 1)->get();
        return view('goals.index', compact('goals'));
    }

    public function create()
    {
        // Get the current date and the date four weeks ago
        $currentDate = Carbon::now();
        $fourWeeksAgo = $currentDate->subWeeks(4);

        // Fetch rides from the last 4 weeks for the logged-in user
        $rides = Ride::where('user_id', Auth::id())
            ->where('start_date', '>=', $fourWeeksAgo)
            ->get();

        // Initialize variables to store total distance and moving time
        $totalDistance = 0;
        $totalMovingTime = 0;
        $weeksCounted = [];

        // Loop through rides to calculate totals and weeks
        foreach ($rides as $ride) {
            $weekNumber = Carbon::parse($ride->start_date)->format('W'); // Get the week number

            // Add distance (assuming it's in kilometers)
            $totalDistance += $ride->distance; 

            // Add moving time (assuming it's in seconds)
            $totalMovingTime += $ride->moving_time; 

            // Track the weeks
            $weeksCounted[$weekNumber] = true; 
        }

        // Calculate the number of weeks with rides
        $totalWeeks = count($weeksCounted);

        // Calculate averages
        $averageDistance = $totalWeeks > 0 ? $totalDistance / 1000 / $totalWeeks : 0; // Average in kilometers
        $averageMovingTime = $totalWeeks > 0 ? ($totalMovingTime / 3600) / $totalWeeks : 0; // Convert to hours and then average

        $averageMovingTime = 2;

        // Suggest a goal based on average distance and time
        $suggestedDistanceGoal = ceil($averageDistance * 1.1); // 10% increase for the goal
        $suggestedTimeGoal = ceil($averageMovingTime * 1.1); // 10% increase for the goal


        return view('goals.create', [
            'averageDistance' => round($averageDistance, 1), // Rounded for better presentation
            'averageMovingTime' => round($averageMovingTime, 1),
            'suggestedDistanceGoal' => $suggestedDistanceGoal,
            'suggestedTimeGoal' => $suggestedTimeGoal,
        ]);
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