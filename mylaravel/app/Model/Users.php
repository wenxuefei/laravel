<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Users extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /*
     * 一对一的关系
     * */
    public function userInfo(){
        return $this->hasOne('App\Model\UsersInfo','user_id');
    }

    /*
     * 一对多的关系
     * */
    public function article(){
        return $this->hasMany('App\Article','user_id');
    }

    /*
     * belongsTo
     * */
    public function country(){
        return $this->belongsTo('App\Model\Conuntry','country_id');
    }

    /*
     * 多对多的关系
     * */
    public function group(){
        return $this->belongsToMany('App\Model\Group','table_group_user','user_id','group_id');
    }
}
