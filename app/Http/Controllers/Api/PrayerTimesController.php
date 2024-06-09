<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Http\Resources\Api\PrayerTimesResource; // Mengimpor dari namespace yang sesuai
use App\Http\Controllers\Controller;

class PrayerTimesController extends Controller
{
    public function getPrayerTimes(Request $request)
    {
        $city = $request->input('city');
        $country = $request->input('country');
        $method = $request->input('method');

        $response = Http::get("http://api.aladhan.com/v1/timingsByCity", [
            'city' => $city,
            'country' => $country,
            'method' => $method
        ]);

        if ($response->successful()) {
            return new PrayerTimesResource($response->json());
        }

        return response()->json(['error' => 'Unable to fetch data from API'], 500);
    }
}
