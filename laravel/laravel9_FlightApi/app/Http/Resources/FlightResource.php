<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class FlightResource extends JsonResource
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
            "data" => [
                "id" => $this->resource["data"]["id"],
                "airportList" => AirportResource::collection($this->resource["data"]["airportList"]),
                "airlineList" => AirlineResource::collection($this->resource["data"]["airlineList"]),
                "flightList" => [
                    "return" => FlightListResource::collection($this->resource["data"]["flightList"]["return"]),
                    "departure" => FlightListResource::collection($this->resource["data"]["flightList"]["departure"]),
                ],
            ],
        ];
    }
}
