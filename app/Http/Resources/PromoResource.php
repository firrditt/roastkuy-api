<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PromoResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'promo_name' => $this->promo_name,
            'image' => $this->image == "-" ? "" : $this->image,
            'type' => $this->type,
            'outdate' => $this->outdate_promo,
            'description' => $this->description,
            'detail_tutorial' => $this->detail_tutorial,
            'detail_condition' => $this->detail_tutorial
        ];
    }
}
