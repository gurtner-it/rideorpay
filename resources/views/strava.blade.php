<!-- resources/views/strava/connect-to-strava.blade.php -->
@extends('layouts.app')

@section('content')
<div class="bg-white shadow-md rounded-lg p-6">
    <h2 class="text-lg font-semibold mb-4">Connect to Strava</h2>
    <p class="mb-6 text-gray-700">Import your rides directly from Strava to track your cycling progress.</p>

    @if(session('strava_access_token'))
        <p class="text-green-600 mb-4">Connected to Strava!</p>
        <a href="{{ route('rides.import') }}" class="w-full block bg-green-600 text-white py-2 rounded-lg text-center hover:bg-green-700">
            Import Rides
        </a>
    @else
        <a href="{{ route('strava.redirect') }}" class="w-full block bg-blue-600 text-white py-2 rounded-lg text-center hover:bg-blue-700">
            Connect to Strava
        </a>
    @endif
</div>
@endsection