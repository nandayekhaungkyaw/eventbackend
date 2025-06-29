<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    /** @use HasFactory<\Database\Factories\TicketFactory> */
    use HasFactory;
    protected $fillable = [
       "event_id",
       'title',
    "amount",
    "available_quantity",
    "sale_start_date",
    "sale_end_date",
    "start_time",
    "end_time",
    "description",
    ];

     public function order(){
        return $this->hasMany(Order::class,'ticket_id','id');
    }
    public function event(){
        return $this->belongsTo(Event::class);
    }
}
