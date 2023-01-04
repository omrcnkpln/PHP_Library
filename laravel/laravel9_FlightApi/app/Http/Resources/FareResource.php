<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class FareResource extends JsonResource
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
            "baseFare" => $this["baseFare"],
            "tax" => $this["tax"],
            "serviceFee" => $this["serviceFee"],
            "quantity" => $this["quantity"],
        ];
    }
}
