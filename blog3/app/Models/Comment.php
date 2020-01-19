<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Comment extends Model
{

    protected $guarded = [];

    public function article(){
        return $this->belongsTo('App\Models\Article');
    }

    public function user(){
        return $this->belongsTo('App\Models\User');
    }

}
