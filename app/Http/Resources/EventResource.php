<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EventResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'event_id' => $this->event_id,
            'event_category' => $this->event_category,
            'event_title' => $this->event_title,
            'event_description' => $this->event_description,
            'event_date' => $this->event_date,
            'event_image' => $this->event_image,
            'event_city' => $this->event_city,
            'event_address' => $this->event_address,
            'event_status' => $this->event_status,
            'event_created_on' => $this->event_created_on,
        ];
        // return parent::toArray($request);
    }
}
