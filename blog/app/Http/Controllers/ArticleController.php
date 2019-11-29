<?php

namespace App\Http\Controllers;

use App\Model\Article;
use App\Model\Category;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //读取文章内容
        $posts = Article::orderBy('id', 'desc')
            ->where(function ($query) use ($request) {
                //检测当前的请求中是否包含keyword参数
                $keyword = $request->input('keyword', '');
                if (!empty($keyword)) {
                    $query->where('title', 'like', '%' . $keyword . '%');
                }
            })
            ->paginate(10);

        return view('admin.article.index', ['posts' => $posts, 'request' => $request]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //读取分类信息和标签信息
        $cates = CategoryController::getCates();
        //读取标签的内容
        $tags = TagController::getTags();

        return view('admin.article.add', [
            'cates' => $cates,
            'tags' => $tags
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //创建模型
        $post = new Article();
        // $post->fill($request->except([]));
        $post->title = $request->input('title');
        $post->content = $request->input('content');
        $post->category_id = $request->input('category_id');
        $post->user_id = 1; //潜规则   当前用户登陆之后需要讲用户的这个uid写入到session中
        //检测是否有文件上传
        if($request->hasFile('img')) {
            //拼接文件夹路径
            $destinationPath = './uploads/'.date('Y-m-d').'/'; //规则 /Upload/20121010/12381902381.jpg
            //拼接文件路径
            $fileName = time().rand(100000, 999999);
            //获取上传文件的后缀
            $suffix = $request->file('img')->getClientOriginalExtension();
            //文件的完整的名称
            $fullName = $fileName.'.'.$suffix;
            //保存文件
            $request->file('img')->move($destinationPath, $fullName);
            //拼接文件上传之后的路径
            $post->img = trim($destinationPath.$fullName,'.');
        }
        if($post->save()) {
            //将tag数据存入到中间表 post_tag中
            if($post->tag()->sync($request->tag_id)) {
                return redirect('/article')->with('info','添加成功');
            }
        }else{
            return back()->with('info','添加失败');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //读取文章的内容
        $article = Article::findOrFail($id);
        //显示文章的内容
        return view('home.detail', ['article'=>$article]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //读取当前id文章的内容
        $info = Article::findOrFail($id);
        $cates = CategoryController::getCates();
        $tags = TagController::getTags();
        //获取所有的文章标签
        $allTags = $info->tag->toArray();
        $ids = [];
        foreach ($allTags as $key => $value) {
            $ids[] = $value['id'];
        }

        //解析模板
        return view('admin.article.edit', ['info'=>$info,'cates'=>$cates,'tags'=>$tags,'ids'=>$ids]);
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
        //创建模型
        $post = Article::findOrFail($id);

        $post->title = $request->input('title');
        $post->content = $request->input('content');
        $post->category_id = $request->input('category_id');
        //检测是否有文件上传
        if($request->hasFile('img')) {
            //拼接文件夹路径
            $destinationPath = './uploads/'.date('Y-m-d').'/'; //规则 /Upload/20121010/12381902381.jpg
            //拼接文件路径
            $fileName = time().rand(100000, 999999);
            //获取上传文件的后缀
            $suffix = $request->file('img')->getClientOriginalExtension();
            //文件的完整的名称
            $fullName = $fileName.'.'.$suffix;
            //保存文件
            $request->file('img')->move($destinationPath, $fullName);
            //拼接文件上传之后的路径
            $post->img = trim($destinationPath.$fullName,'.');
        }

        if($post->save()) {
            //将tag数据存入到中间表 post_tag中
            if($post->tag()->sync($request->tag_id)) {
                return redirect('/article')->with('info','更新成功');
            }
        }else{
            return back()->with('info','更新失败');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //获取模型
        $post = Article::findOrFail($id);
        //删除图片
        @unlink('.'.$post->img);
        //删除
        if($post->delete()) {
            return back()->with('info','删除成功');
        }else{
            return back()->with('info','删除失败');
        }
    }
    public function lists()
    {
        //读取文章的列表
        $articles = Article::orderBy('id','desc')->paginate(10);
        //
        return view('home.lists', ['articles'=>$articles]);
    }
}
