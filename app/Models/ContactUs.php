<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactUs extends Model
{
    public $guarded = ['id'];



    public function user(){
        return $this->belongsTo(User::class);
    }
}
