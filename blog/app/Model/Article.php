<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    //
    public function tag(){
        return $this->belongsToMany('App\Model\Tag');
    }
    public function category(){
        return $this->belongsTo('\App\Model\Category');
    }
}
