<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RecordOrder extends Model
{
    /** @use HasFactory<\Database\Factories\RecordOrderFactory> */
    use HasFactory;
     protected $fillable = [
        'ticket_id',
        'event_id',
        'event_title',
    'ticket_title',
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


}
