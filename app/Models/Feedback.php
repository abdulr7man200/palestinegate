<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    public $guarded = ['id'];



    public function user(){
        return $this->belongsTo(User::class);
    }
    public function booking(){
        return $this->belongsTo(Booking::class);
    }
}


