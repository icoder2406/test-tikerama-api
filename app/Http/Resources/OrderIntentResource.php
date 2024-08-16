<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderIntentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'order_intent_id' => $this->order_intent_id,
            'order_intent_price' => $this->order_intent_price,
            'order_intent_type' => $this->order_intent_type,
            'user_email' => $this->user_email,
            'user_phone' => $this->user_phone,
            'expiration_date' => $this->expiration_date,
        ];
    }
}
