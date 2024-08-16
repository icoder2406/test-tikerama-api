<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
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
            'order_id' => $this->order_id,
            'order_number' => $this->order_number,
            'order_event_id' => $this->order_event_id,
            'order_price' => $this->order_price,
            'order_type' => $this->order_type,
            'order_payment' => $this->order_payment,
            'order_info' => $this->order_info,
            'order_created_on' => $this->order_created_on,
            'order_client_id' => $this->order_client_id,
        ];
    }
}
