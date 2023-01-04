<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class DurationResource extends JsonResource
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
            "day" => $this["day"],
            "hours" => $this["hours"],
            "minutes" => $this["minutes"],
        ];
    }
}
