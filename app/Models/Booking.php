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
    public function stays(){
        return $this->belongsTo(Stays::class, 'stay_id');
    }


}
