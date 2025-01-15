<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Stays extends Model
{
    public $guarded = ['id'];

    public function user(){
        return $this->belongsTo(User::class);
    }
    public function staysPics(){
        return $this->hasMany(StaysPics::class, 'stay_id');
    }
    public function Rooms(){
        return $this->hasMany(Rooms::class, 'stay_id');
    }

    public function feedbacks() {
        return $this->hasManyThrough(Feedback::class, Booking::class, 'car_id', 'stay_id');
    }

}

