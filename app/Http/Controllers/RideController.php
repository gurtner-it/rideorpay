<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Strava;
use Carbon\Carbon;
use App\Models\Ride; // Assuming you have a Ride model
use Illuminate\Support\Facades\Http;

class RideController extends Controller
{
    public function showConnectPage()
    {
        return view('strava');
    }

    /**
     * Redirect the user to Strava's OAuth page.
     */
    public function redirectToStrava()
    {
        $stravaUrl = 'https://www.strava.com/oauth/authorize';
        $queryParams = http_build_query([
            'client_id' => env('STRAVA_CLIENT_ID'),
            'redirect_uri' => env('STRAVA_REDIRECT_URI'),
            'response_type' => 'code',
            'scope' => 'activity:read_all'
        ]);

        return redirect("{$stravaUrl}?{$queryParams}");
    }

    /**
     * Handle the OAuth callback from Strava.
     */
    public function handleStravaCallback(Request $request)
    {
        $code = $request->input('code');
        if (!$code) {
            return redirect()->route('strava.redirect')->with('error', 'Authorization failed.');
        }

        $response = Http::post('https://www.strava.com/oauth/token', [
            'client_id' => env('STRAVA_CLIENT_ID'),
            'client_secret' => env('STRAVA_CLIENT_SECRET'),
            'code' => $code,
            'grant_type' => 'authorization_code',
        ]);

        $data = $response->json();

        if (isset($data['access_token'])) {
            session(['strava_access_token' => $data['access_token']]);
            return redirect()->route('rides.import')->with('success', 'Connected to Strava!');
        }

        return redirect()->route('strava.redirect')->with('error', 'Failed to get access token.');
    }


    /**
     * Import rides from Strava.
     */
    public function importRides()
    {
        $accessToken = session('strava_access_token');

        if (!$accessToken) {
            return redirect()->route('strava.redirect')->with('error', 'Please connect to Strava first.');
        }

        $page = 1; // Start with the first page
        $perPage = 30; // Number of activities per page
        $totalImportedRides = 0; // Track the total number of imported rides

        while ($totalImportedRides < 100) {
            // Fetch the list of rides (activities) from Strava
            $response = Http::withToken($accessToken)
                ->get('https://www.strava.com/api/v3/athlete/activities', [
                    'per_page' => $perPage,
                    'page' => $page
                ]);

            $rides = $response->json();

            // Break if no more rides are returned
            if (empty($rides)) {
                break;
            }

            foreach ($rides as $ride) {
                // Import ride only if we have imported less than 100 rides
                if ($totalImportedRides < 100) {
                    Ride::updateOrCreate(
                        ['strava_id' => $ride['id']],
                        [
                            'user_id' => auth()->id(), // Associate with the logged-in user
                            'name' => $ride['name'] ?? 'Unknown Ride', // Default name if not provided
                            'distance' => $ride['distance'] ?? 0, // Default to 0 if not provided
                            'moving_time' => $ride['moving_time'] ?? 0, // Default to 0 if not provided
                            'elapsed_time' => $ride['elapsed_time'] ?? 0, // Default to 0 if not provided
                            'elevation_gain' => $ride['total_elevation_gain'] ?? 0, // Default to 0 if not provided
                            'type' => $ride['type'] ?? 'Unknown', // Default type if not provided
                            'start_date' => $ride['start_date'] ?? now(), // Default to current time if not provided
                            'average_speed' => $ride['average_speed'] ?? 0, // Default to 0 if not provided
                        ]
                    );
                    $totalImportedRides++;
                }
            }

            $page++; // Move to the next page
        }

        return redirect()->route('goals.index')->with('success', "$totalImportedRides rides imported successfully!");
    }

    /**
     * Import rides from Strava.
     */
    public function importRidesOld()
    {
        $accessToken = session('strava_access_token');

        if (!$accessToken) {
            return redirect()->route('strava.redirect')->with('error', 'Please connect to Strava first.');
        }

        // Fetch the list of rides (activities) from Strava
        $response = Http::withToken($accessToken)
            ->get('https://www.strava.com/api/v3/athlete/activities', [
                'per_page' => 30, // Number of activities per page
                'page' => 1
            ]);

        $rides = $response->json();

         foreach ($rides as $ride) {
            Ride::updateOrCreate(
                ['strava_id' => $ride['id']],
                [
                    'user_id' => auth()->id(), // Associate with the logged-in user
                    'name' => $ride['name'] ?? 'Unknown Ride', // Default name if not provided
                    'distance' => $ride['distance'] ?? 0, // Default to 0 if not provided
                    'moving_time' => $ride['moving_time'] ?? 0, // Default to 0 if not provided
                    'elapsed_time' => $ride['elapsed_time'] ?? 0, // Default to 0 if not provided
                    'elevation_gain' => $ride['total_elevation_gain'] ?? 0, // Default to 0 if not provided
                    'type' => $ride['type'] ?? 'Unknown', // Default type if not provided
                    'start_date' => $ride['start_date'] ?? now(), // Default to current time if not provided
                    'average_speed' => $ride['average_speed'] ?? 0, // Default to 0 if not provided
                ]
            );
        }

        return redirect()->route('goals.index')->with('success', 'Rides imported successfully!');
    }
}