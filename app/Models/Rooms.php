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

}
