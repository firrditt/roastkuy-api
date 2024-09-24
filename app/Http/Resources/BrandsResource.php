<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BrandsResource extends JsonResource
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
            'outlet_name' => $this->outlet_name ?? '',
            'slug' => $this->slug ?? '',
            'address' => $this->address ?? '',
            'lat' => (double) ($this->lat ?? 0),
            'lon' => (double) ($this->lon ?? 0),
            'operation_time' => $this->operation_time ?? '',
            'contact' => $this->contact ?? '',
            'description' => $this->description ?? '',
            'logo'=> $this->logo ?? '',
            'cover' => $this->cover ?? '',
            'banner' => $this->banner ?? '',
            'featured_image' => $this->featured_image ?? '',
            'gofood_link' => $this->gofood_link ?? '',
            'shopeefood_link' => $this->shopeefood_link ?? '',
            'grabfood_link' => $this->grabfood_link ?? '',
            'travelokaeats_link' => $this->travelokaeats_link ?? '',
        ];
    }
}
