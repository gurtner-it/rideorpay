@extends('layouts.app')

@section('title', 'Add New Goal')

@section('content')
    <h1>Add New Goal</h1>
    <form action="{{ route('goals.store') }}" method="POST">
        @csrf
        <label for="target_hours">Target Hours:</label>
        <input type="number" name="target_hours" required min="1">
        <button type="submit">Add Goal</button>
    </form>
    <a href="{{ route('goals.index') }}">Back to Goals</a>
@endsection