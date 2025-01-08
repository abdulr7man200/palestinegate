<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StaysPics extends Model
{
    public $guarded = ['id'];

    public function stay(){
        return $this->belongsTo(Stays::class, 'stay_id');
    }
}
