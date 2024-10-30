@extends('layouts.app')

@section('content')
    <h1>Your Strava Rides</h1>
    <a href="{{ route('strava.redirect') }}" class="btn btn-primary">Connect to Strava</a>

    <ul>
        @foreach($rides as $ride)
            <li>{{ $ride->name }} - {{ $ride->distance }} km</li>
        @endforeach
    </ul>
@endsection