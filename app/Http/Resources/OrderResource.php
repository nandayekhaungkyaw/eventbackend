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
      return [
    'id' => $this->id,

   "payment_method"=>$this->payment_method,
        "transaction_id"=>$this->transaction_id,

    'quantity' => $this->quantity,
    'total_amount' => $this->total_amount,
    'phone' => $this->phone,
    'status' => $this->status,
    'first_name' => $this->first_name,
    'last_name' => $this->last_name,
    'email' => $this->email,
    'confirmed_email' => $this->confirmed_email,
    'ticket_id' => $this->ticket_id,
    'ticket' => [
        'id' => $this->ticket->id,
            'title' => $this->ticket->title,
            'amount' => $this->ticket->amount,
            'event_id' => $this->ticket->event_id
    ],
    'event_id' => $this->event_id,
   'event' => new EventResource($this->event),
];

    }
}
