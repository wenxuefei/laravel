<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
    public function article(){
        return $this->belongsToMany(\App\Models\Article::class,'article_topic','topic_id','article_id');
    }

    public function articleTopic(){
        return $this->hasMany(\App\Models\ArticleTopic::class,'topic_id');
    }
}
