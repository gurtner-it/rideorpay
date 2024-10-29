@extends('layouts.app')

@section('content')
<div>
    <h1>Your Goals</h1>
    <a href="{{ route('goals.create') }}">Add New Goal</a>
    <ul>
        @foreach($goals as $goal)
            <li>
                Target Hours: {{ $goal->target_hours }}, Actual Hours: {{ $goal->actual_hours }}, Met: {{ $goal->met ? 'Yes' : 'No' }}
                <form action="{{ route('goals.destroy', $goal->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Delete</button>
                </form>
            </li>
        @endforeach
    </ul>
</div>
@endsection