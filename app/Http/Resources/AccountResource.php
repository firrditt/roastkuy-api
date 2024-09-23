<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AccountResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'uuid' => $this->uuid,
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'is_active' => $this->phone_verified_at != null ? 1 : 0,
            'member_number' => $this->email_verified_at != null ? $this->member_number : "",
            'point' => $this->point == null ? 0 : $this->point,
            'promo_count' => $this->promos->count(),
            'promo' => $this->email_verified_at != null ? 1 : 0,
        ];
    }
}
