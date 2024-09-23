<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MenuResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        // return parent::toArray($request);

        return [
            // 'outlet' => $this->outlet->outlet_name,
            'id' => $this->id,
            'menu_name' => $this->menu_name,
            'description' => $this->description,
            'category' => $this->menusCategory->name_category,
            'image' => $this->image,
            'price' => (integer) $this->price,
            'discount' => (integer) $this->discount
        ];
    }
}
