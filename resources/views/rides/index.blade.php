@extends('layouts.app')

@section('title', 'Your Strava Rides')

@section('content')
    <div class="bg-white shadow-md rounded-lg p-6 mb-6">
        <h1 class="text-3xl font-bold mb-4">Your Strava Rides</h1>

        <a href="{{ route('goals.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 mb-4">
           Create a goal
        </a>


        @if ($rides->isEmpty())
            <p class="text-gray-500 mb-4">You have no rides imported from Strava. Connect to Strava to get started!</p>

            <a href="{{ route('strava.redirect') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 mb-4">
                Connect to Strava
            </a>

        @else
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 mt-6">
                @foreach($rides as $ride)
                    <div class="bg-white shadow-md rounded-lg p-6 mb-4 transition-transform transform hover:scale-105">
                        <h2 class="font-semibold text-xl text-blue-600 mb-2">{{ $ride->name }}</h2>
                        <div class="grid grid-cols-2 gap-y-4">
                            <div class="flex items-center">
                                <i class="fas fa-bicycle mr-1"></i>
                                <p class="text-gray-600 text-sm">
                                    <span class="font-bold">{{ $ride->formatted_distance }}</span>
                                </p>
                            </div>
                            <div class="flex items-center justify-end">
                                <p class="text-gray-600 text-sm">
                                    <span class="font-bold">{{ $ride->formatted_start_date }}</span>
                                </p>
                            </div>
                            
                            <div class="flex items-center">
                                <i class="fas fa-clock mr-1"></i>
                                <p class="text-gray-600 text-sm">
                                    <span class="font-bold">{{ $ride->formatted_moving_time }}</span>
                                </p>
                            </div>
                            <div class="flex items-center justify-end">
                                <i class="fas fa-angle-double-up mr-1"></i>
                                <p class="text-gray-600 text-sm">
                                    <span class="font-bold">{{ $ride->formatted_elevation_gain }}</span>
                                </p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
@endsection