<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AirportResource extends JsonResource
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
            "is_city" => $this["is_city"],
            "code" => $this["code"],
            "name" => $this["name"],
            "city_code" => $this["city_code"],
            "city_name" => $this["city_name"],
            "country_code" => $this["country_code"],
            "country_name" => $this["country_name"],
        ];
    }
}
