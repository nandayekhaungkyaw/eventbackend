<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    /** @use HasFactory<\Database\Factories\ImageFactory> */
    use HasFactory;
      protected $fillable = [
        'event_id',
        'image',
    ];
    public function event()
    {
        return $this->belongsTo(Event::class);
    }
}
