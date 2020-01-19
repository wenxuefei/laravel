<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Topic;
use Illuminate\Http\Request;

class TopicController extends Controller
{
    public function show(Topic $topic){
        $topic = Topic::withCount('articleTopic')->find($topic->id);
        $posts = $topic->article()->orderBy('created_at','desc')->take(10)->get();
        $myposts = Article::authorBy(auth()->id())->topicNotBy($topic->id)->get();
        return view('home.topic.show',compact('topic','posts','myposts'));
    }

    public function submit(Topic $topic){
        $this->validate(\request(),[
           'post_ids'=>'required|array',
        ]);

        $post_ids = \request('post_ids');
        $topic_id = $topic->id;

        foreach ($post_ids as $article_id){
            \App\Models\ArticleTopic::firstOrCreate(compact('topic_id','article_id'));
        }

        return back();
    }
}
