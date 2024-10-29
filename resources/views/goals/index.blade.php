@extends('layouts.app')

@section('title', 'Your Goals')

@section('content')
    <h1>Your Goals</h1>
    <a href="{{ route('goals.create') }}">Add New Goal</a>
    <ul>
        @foreach($goals as $goal)
            <li>
                Target Hours: {{ $goal->target_hours }}, Actual Hours: {{ $goal->actual_hours }}, Met: {{ $goal->met ? 'Yes' : 'No' }}
                <form action="{{ route('goals.destroy', $goal->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" onclick="return confirm('Are you sure you want to delete this goal?')">Delete</button>
                </form>
            </li>
        @endforeach
    </ul>
@endsection