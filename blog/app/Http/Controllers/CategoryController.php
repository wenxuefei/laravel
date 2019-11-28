<?php

namespace App\Http\Controllers;

use App\Model\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //读取所有分类
        $cates = Category::get();
        return view('admin.category.add', ['cates' => $cates]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $data = $request->all();
        //如果要添加的是顶级分类  pid 和path都是0
        if($data['pid'] == 0 ){
            $data['path'] = '0';
        }else{//如果不是顶级分类
            //读取父级分类的信息
            $info = Category::find($data['pid']);
            $data['path'] = $info->path.','.$info->id;
        }
        //创建模型
        $cate = new Category();
        $cate->name = $data['name'];
        $cate->pid = $data['pid'];
        $cate->path = $data['path'];
        //
        if($cate->save()) {
            return redirect('/category')->with('info', '分类添加成功');
        }else{
            return back()->with('info','分类添加失败');
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
