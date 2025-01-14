<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    public $guarded = ['id'];

    public function car(){
        return $this->belongsTo(Cars::class, 'car_id');
    }
    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }
    public function store(){
        return $this->belongsTo(User::class, 'store_id');
    }
    public function stay(){
        return $this->belongsTo(Stays::class, 'stay_id');
    }
    public function room(){
        return $this->belongsTo(Rooms::class, 'room_id');
    }

    // Rooms model
    public function feedback()
    {
        return $this->hasOne(Feedback::class, 'booking_id');
    }




}
