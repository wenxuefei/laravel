<?php

namespace App\Models;

use Facade\FlareClient\View;
use Illuminate\Foundation\Auth\User as Authenticatable;
class User extends Authenticatable
{


    protected $guarded = [];

    public function articles(){
        return $this->hasMany('App\Models\Article','user_id','id');
    }

    public function fans(){
        return $this->hasMany('App\Models\Fans','star_id','id');
    }

    public function star(){
        return $this->hasMany('App\Models\Fans','fan_id','id');
    }

    public function doFan($id){
        $fan = new Fans();
        $fan->star_id = $id;
        return $this->star()->save($fan);
    }

    public function doUnFan($id){
        $fan = new Fans();
        $fan->star_id = $id;
        return $this->star()->delete($fan);
    }
    public function hasFan($id){
        return $this->star()->where('fan_id',$id)->count();
    }

    public function hasStar($id){
        return $this->star()->where('star_id',$id)->count();
    }

    public function notices(){
        return $this->belongsToMany(\App\Models\Notice::class,'user_notices','user_id','notice_id')->withPivot(['user_id','notice_id']);
    }

    public function addNotice($notice){
        return $this->notices()->save($notice);
    }

}
