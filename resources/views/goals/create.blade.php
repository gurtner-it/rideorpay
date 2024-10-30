@extends('layouts.app')

@section('content')
<div class="bg-white shadow-md rounded-lg p-6">
    <h2 class="text-lg font-semibold mb-4">Add a New Goal</h2>

    <div class="mb-4">
        <p class="text-lg">Average Distance (last 4 weeks): <strong>{{ $averageDistance }} km</strong></p>
        <p class="text-lg">Average Moving Time (last 4 weeks): <strong>{{ $averageMovingTime }} hours</strong></p>
    </div>

    <div class="mb-4">
        <p class="text-lg">Suggested Distance Goal: <strong>{{ $suggestedDistanceGoal }} km</strong></p>
        <p class="text-lg">Suggested Time Goal: <strong>{{ $suggestedTimeGoal }} hours</strong></p>
    </div>
    <form action="{{ route('goals.store') }}" method="POST">
        @csrf
        <div class="mb-4">
            <label for="target_hours" class="block text-sm font-medium text-gray-700">Target Hours per week</label>
            <input type="range" name="target_hours" id="target_hours" min="0" max="24" step="0.5" value="{{ $suggestedTimeGoal }}" class="mt-1 w-full h-2 bg-blue-200 rounded-lg appearance-none cursor-pointer" />
            <p class="text-center text-lg mt-2"><strong id="sliderValue">{{ $suggestedTimeGoal }}</strong> hours</p>
        </div>
        <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded-lg hover:bg-blue-700">Add Goal</button>
    </form>

    <script>
        const slider = document.getElementById('target_hours');
        const output = document.getElementById('sliderValue');
        
        // Display the default slider value
        output.innerHTML = slider.value;

        // Update the current slider value (each time you drag the slider handle)
        slider.oninput = function() {
            output.innerHTML = this.value;
        }
    </script>
</div>
@endsection