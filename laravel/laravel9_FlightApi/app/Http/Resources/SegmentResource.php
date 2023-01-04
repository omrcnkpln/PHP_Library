<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SegmentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {

        return [
            "segments" => [
                "airline" => $this["airline"],
                "flightNumber" => $this["flightNumber"],
                "departureAirport" => $this["departureAirport"],
                "arrivalAirport" => $this["arrivalAirport"],
                "departureDatetime" => $this["departureDatetime"],
                "arrivalDatetime" => $this["arrivalDatetime"],
                "class" => $this["class"],
                "availableSeats" => $this["availableSeats"],
                "duration" => DurationResource::make($this["duration"]),
            ],
        ];
    }
}
