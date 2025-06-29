<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    /** @use HasFactory<\Database\Factories\EventFactory> */
    use HasFactory;

protected $fillable=[
     'title',
        'description',
        'location',
        'category_id',
        'type_id',
        'start_date',
        'end_date',
        'start_time',
        'end_time' ,
        'googleMap',
        'price',

];

    public function category(){
        return $this->belongsTo(Category::class,'category_id','id');
    }
    public function type(){
        return $this->belongsTo(Type::class,'type_id','id');
    }

    public function faq(){
        return $this->hasMany(Faq::class,'event_id','id');
    }

    public function image(){
        return $this->hasMany(Image::class,'event_id','id');
    }
    public function ticket(){
        return $this->hasMany(Ticket::class,'event_id','id');
    }
    public function order(){
        return $this->hasMany(Order::class,'event_id','id');
    }

}
