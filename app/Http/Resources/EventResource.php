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

            'id'  => $this->id,
            "title"  => $this->title,
            "description"  => $this->description,
            "category_id"  => $this->category_id,
              "start_date"  => $this->start_date,
            "end_date"  => $this-> end_date,
            "start_time"  => $this->start_time,
            "end_time"  => $this->end_time,
            "created_at"  => $this->created_at,
            "updated_at"  => $this->updated_at,
            'location'  => $this->location,
            'googleMap'  => $this->googleMap,
           'price'  => $this->price,
            "category"=>[
                "id"=>$this->category->id,
                "name"=>$this->category->name,
                "description"=>$this->category->description

            ],
            "type_id"  => $this->type_id,
            "type"=>[
                "id"=>$this->type->id,
                "name"=>$this->type->name
            ],


        ];
    }
}
