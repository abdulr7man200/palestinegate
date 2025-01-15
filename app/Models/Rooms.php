<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rooms extends Model
{
    public $guarded = ['id'];


    public function stay(){
        return $this->belongsTo(Stays::class);
    }

    public function room_pics(){
        return $this->hasMany(RoomPics::class, 'room_id');
    }


    public function user(){
        return $this->belongsTo(User::class);
    }

    public function feedbacks() {
        return $this->hasManyThrough(Feedback::class, Booking::class, 'room_id', 'booking_id');
    }
}
