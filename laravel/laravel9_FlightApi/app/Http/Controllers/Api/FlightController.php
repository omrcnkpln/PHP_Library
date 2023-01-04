<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\FlightRequest;
use App\Http\Resources\FlightResource;
use Illuminate\Support\Facades\Http;

class FlightController extends Controller
{
    public function searchForFlight(FlightRequest $request)
    {
        $response = Http::withOptions([
            'verify' => false,
        ])->post('https://biletbayisi.com/api/flight-ticket/get-flights', [
            "origin" => $request->origin,
            "destination" => $request->destination,
            "departure_date" => $request->departure_date,
            "return_date" => $request->return_date,
            "passengers" => array(
                "ADT" => $request->passengers["ADT"],
                "CHD" => $request->passengers["CHD"],
                "INF" => $request->passengers["INF"],
            )]);

        return new FlightResource($response->json());
    }
}
