<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FaqResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
       return [
           'id'=>$this->id,
           'question'=>$this->question,
           'answer'=>$this->answer,
           'event_id'=>$this->event_id,
           'event_title'=>$this->event->title,
       ];
    }
}
