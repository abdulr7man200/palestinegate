<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cars extends Model
{
    public $guarded = ['id'];



    public function user(){
        return $this->belongsTo(User::class);
    }

    public function carPics(){
        return $this->hasMany(CarPics::class, 'car_id');
    }

    public function booking(){
        return $this->hasMany(Booking::class, 'car_id');
    }
    public function feedbacks() {
        return $this->hasManyThrough(Feedback::class, Booking::class, 'car_id', 'booking_id');
    }

}
