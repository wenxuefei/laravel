<?php

namespace App\Http\Controllers\Home;

use App\Models\Article;
use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Zan;
use Illuminate\Http\Request;
use phpDocumentor\Reflection\DocBlock\Tags\Return_;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $article = new Article();
        // ->with('user') 预加载
        $articles = $article->orderBy('created_at', 'desc')->withCount(['comment','zans'])->with('user')->paginate(6);

//        $articles->load('user'); 预加载
        return view('home.article.index', ['articles' => $articles]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('home.article.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|string|max:100|min:5',
            'content' => 'required|string|min:10'
        ]);
        $article = new Article();
        $user_id = auth()->id();
        $params = $request->all();
        $params['user_id'] = $user_id;

        $article->create($params);
        return redirect('/article');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $article = new Article();
        $article = $article->find($id);
        $article->load('comment');
        return view('home.article.show', ['article' => $article]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $article = new Article();
        $article = $article->find($id);
        return view('home.article.edit', ['article' => $article]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title' => 'required|string|max:100|min:5',
            'content' => 'required|string|min:10'
        ]);

        $article = new Article();
        $article = $article->findOrFail($id);

        $this->authorize('update',$article);

        $article->title = $request->get('title');
        $article->content = $request->get('content');
        $article->save();

        return redirect("/article/" . $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $article = new Article();
        $article->where('id', $id)->delete();
        return redirect('/article');
    }

    public function upload(Request $request)
    {
        $path = $request->file('wangEditorH5File')->storePublicly(md5(time()));
        return asset('storage/' . $path);
    }

    public function comment(Request $request,$id){
        $this->validate($request,[
            'content' => 'required|min:3',
        ]);

        $article = new Article();
        $article->id = $id;

        $comment = new Comment();

        $comment->user_id = auth()->id();
        $comment->content = $request->get('content');
        $article->comment()->save($comment);

        return back();
    }

    public function zan($id){
        $params = [
            'user_id' =>auth()->id(),
            'article_id' => $id
        ];
        Zan::firstOrCreate($params);

        return back();
    }

    public function unzan($id){
        $article = new Article();
        $article = $article->find($id);
        $article->zan(auth()->id())->delete();

        return back();
    }

    public function search(){
        $this->validate(request(),[
            'query' => 'required'
        ]);
        $query = request('query');
        $posts = Article::search(request('query'))->paginate(10);

        return view('home.article.search', compact('posts', 'query'));
    }

    public function test(){

        return view('home.article.test');
    }
}
