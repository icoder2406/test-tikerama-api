<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TicketResource extends JsonResource
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
            'ticket_id' => $this->ticket_id,
            'ticket_event_id' => $this->ticket_event_id,
            'ticket_email' => $this->ticket_email,
            'ticket_phone' => $this->ticket_phone,
            'ticket_price' => $this->ticket_price,
            'ticket_order_id' => $this->ticket_order_id,
            'ticket_order_id' => $this->ticket_order_id,
            'ticket_key' => $this->ticket_key,
            'ticket_ticket_type_id' => $this->ticket_ticket_type_id,
            'ticket_status' => $this->ticket_status,
            'ticket_created_on' => $this->ticket_created_on,
        ];
    }
}
