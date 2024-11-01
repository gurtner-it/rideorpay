@extends('layouts.app')

@section('title', 'Your Goals')

@section('content')
<div class="bg-white shadow-md rounded-lg p-6 mb-8">
    <h1 class="text-3xl font-bold mb-4 text-gray-900">Your Goals</h1>

    <div class="flex items-center mt-6 mb-6">
        <a href="{{ route('goals.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 mr-2">
            Create New Goal
        </a>
        <a href="{{ route('rides.import') }}" class="bg-gray-400 text-white px-4 py-2 rounded hover:bg-gray-600 mr-2">
            Import Rides
        </a>
        <a href="{{ route('rides.index') }}" class="bg-gray-400 text-white px-4 py-2 rounded hover:bg-gray-600">
            View Rides
        </a>
    </div>

    @if ($activeGoal)
        <div class="bg-blue-50 p-6 rounded-lg shadow mb-6">

            <!-- Success Message if Goal is 100% Met -->
            @if ($actualHours >= $activeGoal->target_hours)
                <div class="bg-green-100 text-green-700 p-4 rounded mb-4">
                    <strong>🎉 Congratulations!</strong> You've successfully achieved your goal of {{ $activeGoal->target_hours }} hours!

                    <!-- Button to Get Discount -->
                    <div class="mt-4">
                        <a href="{{ route('discount.claim', $activeGoal->brand) }}" 
                           class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">
                            Claim Your Discount!
                        </a>
                    </div>
                </div>

            @endif

            <h2 class="text-2xl font-semibold text-blue-700">🎯 Current Goal</h2>
            <p class="text-gray-700 mt-2">Target Hours: <strong>{{ $activeGoal->target_hours }} hours</strong></p>
            <p class="text-gray-700">Actual Hours: <strong>{{ $actualHours }}</strong> hour and <strong>{{ $actualMinutes }} minutes</strong></p>
            
            <!-- Progress bar -->
            <div class="mt-4">
                <div class="w-full bg-gray-200 rounded-full h-4">
                    <div 
                        class="bg-blue-600 h-4 rounded-full transition-all duration-300"
                        style="width: {{ min(($actualHours / $activeGoal->target_hours) * 100, 100) }}%">
                    </div>
                </div>

                <p class="text-gray-600 text-sm mt-2">Progress: {{ round(($actualHours / $activeGoal->target_hours) * 100) }}%</p>
            </div>

            @if ($actualHours < $activeGoal->target_hours)
                <!-- Countdown -->
                <div class="mt-4">
                    <p class="text-gray-600">
                        🕒 <strong>{{ $remainingDays }}</strong> days and <strong>{{ $remainingHours }}</strong> hours left to achieve this goal!
                    </p>
                </div>
            @endif

        </div>
    @else
        <p class="text-gray-500 mb-4">You currently have no active goals. Start by adding a new one!</p>
    @endif


    <!-- Archived Goals -->
    @if (!$archivedGoals->isEmpty())
        <h2 class="text-2xl font-bold text-gray-900 mt-8">📅 Goal Archive</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 mt-4">
            @foreach($archivedGoals as $goal)
                <div class="bg-white shadow-md rounded-lg p-4 flex flex-col justify-between">
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900">Target Hours: {{ $goal->target_hours }}</h3>
                        <p class="text-gray-700">Actual Hours: {{ $goal->actual_hours }}</p>
                        <p class="text-gray-700">Goal Met: <span class="{{ $goal->met ? 'text-green-600' : 'text-red-600' }}">
                            {{ $goal->met ? 'Yes 🎉' : 'No 😔' }}</span>
                        </p>
                    </div>
                    <form action="{{ route('goals.destroy', $goal->id) }}" method="POST" class="mt-4">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600"
                                onclick="return confirm('Are you sure you want to delete this goal?')">
                            Delete
                        </button>
                    </form>
                </div>
            @endforeach
        </div>
    @else
        <p class="text-gray-500 mt-4">No past goals yet. Complete a goal to start building your archive!</p>
    @endif
</div>
@endsection