<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Fans extends Model
{
    protected $guarded = [];

    //粉丝用户
    public function fuser(){
        return $this->hasOne('App\Models\User','id','fan_id');
    }

    public function suser(){

        return $this->hasOne('App\Models\User','id','star_id');
    }
}
