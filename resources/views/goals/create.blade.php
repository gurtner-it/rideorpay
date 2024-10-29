@extends('layouts.app')

@section('content')
<div>
    <h1>Add New Goal</h1>
    <form action="{{ route('goals.store') }}" method="POST">
        @csrf
        <label for="target_hours">Target Hours:</label>
        <input type="number" name="target_hours" required>
        <button type="submit">Create Goal</button>
    </form>
</div>
@endsection