<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;

class LoginResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "code" => "success",
            "message" => $this->message,
            "data" => [
                "expires_in" => $this->data['expires_in'],
                "token" => $this->data['token'],
                "is_active" => $this->is_active->email_verified_at == null? $this->is_active->email : "active",
                // "is_active" => $this->is_active->phone_verified_at == null? $this->is_active->phone : "active",
            ],
        ];
    }


    /**
     * Customize the outgoing response for the resource.
     */
    public function withResponse(Request $request, JsonResponse $response): void
    {
        $response->header('X-Token', $this->data["token"])->header('Access-Control-Expose-Headers', 'X-Token');
    }
}
