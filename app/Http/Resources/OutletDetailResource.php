<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OutletDetailResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'outlet_name' => $this->outlet_name,
            'slug' => $this->slug,
            'address' => $this->address,
            'lat' => (double) $this->lat,
            'lon' => (double) $this->lon,
            'operation_time' => $this->operation_time,
            'contact' => $this->contact,
            'gofood_link' => $this->gofood_link ,
            'shopeefood_link' => $this->shopeefood_link,
            'grabfood_link' => $this->grabfood_link ,
            'travelokaeats_link' => $this->travelokaeats_link ,
            'menu' => MenuResource::collection($this->menus)
        ];
    }
}
