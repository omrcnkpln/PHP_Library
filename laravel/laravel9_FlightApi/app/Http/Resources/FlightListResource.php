<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class FlightListResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            "id" => $this["id"],
            "direction" => $this["direction"],
            "departureDatetime" =>$this["departureDatetime"],
            "arrivalDatetime" =>$this["arrivalDatetime"],
            "departureAirport" =>$this["departureAirport"],
            "arrivalAirport" =>$this["arrivalAirport"],
            "viewPrice" =>$this["viewPrice"],
            "availableSeats" =>$this["availableSeats"],
            "viewBaggage" => ViewBaggageResource::make($this["viewBaggage"]),
            "baggageInfo" => BaggageInfoResource::collection($this["baggageInfo"]),
            "fares" => FareResource::collection($this["fares"]),
            "duration" => DurationResource::make($this["duration"]),
            "segments" => SegmentResource::collection($this["segments"]),
        ];
    }
}
