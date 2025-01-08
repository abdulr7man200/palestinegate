<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CarPics extends Model
{

    public $guarded = ['id'];

    public function car(){
        return $this->belongsTo(Cars::class, 'car_id');
    }
}
