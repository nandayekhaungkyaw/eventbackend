<?php

namespace App\Http\Resources;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ImageResource extends JsonResource
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
            'image' => $this->image,
            'url' => asset('storage/eventImages/' . $this->image),
            'created_at' => $this->created_at,
            'event'=>EventResource::make($this->event),

        ];
    }
}
