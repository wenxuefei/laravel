<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function index(){
        $articles = Article::withoutGlobalScope('avaiable')->where('status',0)->orderBy('created_at','desc')->paginate(10);
    }
}
