@extends('layouts.app')

@section('title', 'Your Goals')

@section('content')
    <div class="bg-white shadow-md rounded-lg p-6 mb-6">
        <h1 class="text-3xl font-bold mb-4">Your Goals</h1>
        
        @if ($goals->isEmpty())
            <p class="text-gray-500 mb-4">You have no goals yet. Start by adding a new goal!</p>
            <a href="{{ route('goals.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                Create a New Goal
            </a>
        @else
            <a href="{{ route('goals.create') }}" class="bg-blue-500 text-white px-6 py-2 rounded hover:bg-blue-600 mb-4">
                Add New Goal
            </a>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 mt-6">
                @foreach($goals as $goal)
                    <div class="bg-white shadow-md rounded-lg p-4 flex flex-col justify-between">
                        <div>
                            <h2 class="font-semibold text-lg">Target Hours: {{ $goal->target_hours }}</h2>
                            <p class="text-gray-600">Actual Hours: {{ $goal->actual_hours }}</p>
                            <p class="text-gray-600">Met: {{ $goal->met ? 'Yes' : 'No' }}</p>
                        </div>
                        <form action="{{ route('goals.destroy', $goal->id) }}" method="POST" class="mt-4">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600" onclick="return confirm('Are you sure you want to delete this goal?')">
                                Delete
                            </button>
                        </form>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
@endsection