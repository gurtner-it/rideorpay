<!-- resources/views/goals/create.blade.php -->
@extends('layouts.app')

@section('content')
<div class="bg-white shadow-md rounded-lg p-6">
    <h2 class="text-lg font-semibold mb-4">Add a New Goal</h2>
    <form action="{{ route('goals.store') }}" method="POST">
        @csrf
        <div class="mb-4">
            <label for="target_hours" class="block text-sm font-medium text-gray-700">Target Hours</label>
            <input type="number" name="target_hours" id="target_hours" required class="mt-1 block w-full border border-gray-300 rounded-md p-2" placeholder="Enter hours" />
        </div>
        <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded-lg hover:bg-blue-700">Add Goal</button>
    </form>
</div>
@endsection