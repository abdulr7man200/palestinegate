<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RoomPics extends Model
{
    public $guarded = ['id'];


    public function room(){
        return $this->belongsTo(Rooms::class);
    }
}
