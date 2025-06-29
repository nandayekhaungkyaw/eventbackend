<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    /** @use HasFactory<\Database\Factories\OrderFactory> */
    use HasFactory;
    protected $fillable = [
        'ticket_id',
        'event_id',
         'quantity' ,
    'total_amount',
    'phone'  ,
    'status' ,
    'first_name',
    'last_name' ,
    'email',
    'confirmed_email',
    'payment_method',
    'transaction_id',
    ];

    public function ticket()
    {
        return $this->belongsTo(Ticket::class);
    }
    public function event()
    {
        return $this->belongsTo(Event::class);
    }
}
