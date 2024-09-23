<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MenuDetailResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'menu_name' => $this->menu_name,
            'menu_name' => $this->menu_name,
            'description' => $this->description,
            'category' => $this->menusCategory->name_category,
            'image' => $this->image,
            'price' => (integer) $this->price,
            'discount' => (integer) $this->discount,
            'complement' => ComplementResource::collection($this->complement)
        ];
    }
}
