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
       return [
        'id' => $this->id,
        'event_id' => $this->event_id,
        'event_name'=>$this->event->title,
        'amount' => $this->amount,
        'title' => $this->title,
        'available_quantity' => $this->available_quantity,
        'sale_start_date' => $this->sale_start_date,
        'sale_end_date' => $this->sale_end_date,
        'start_time' => $this->start_time,
        'end_time' => $this->end_time,
        'created_at' => $this->created_at,
        'updated_at' => $this->updated_at
       ];
    }
}
