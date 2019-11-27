<?php

namespace App\Http\Controllers;

use App\Article;
use App\Model\Goods;
use App\Model\Group;
use App\Model\Users;

use http\Client\Curl\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{

    //
    public function index($id)
    {
        echo '这是用户界面';
        echo "<br/>";

        echo "用户ID：" . $id;
    }

    public function requestTest(Request $request)
    {
        $method = $request->method();
        $flag = $request->isMethod('get');
        $path = $request->path();
        $url = $request->url();
        $ip = $request->ip();
        $port = $request->getPort();
        $name = $request->input('name');
        $age = $request->input('age');
        echo "<pre>";
        echo $method . "<br/>";
        var_dump($flag);
        echo "<br/>" . '这是一个请求' . "<br/>";
        echo $path . '<br/>';
        echo $url . '<br/>';
        echo $ip . '<br/>';
        echo $port . '<br/>';
        echo $name . '<br/>';
        echo $age . '<br/>';

        // 设置默认值
        $vip = $request->input('vip', 2);
        $star = $request->has('star');
        $all = $request->all();
        $only = $request->only(['name', 'age']);
        $exp = $request->except(['name', 'age']);
        $header = $request->header();
        $userAgent = $request->header('user-agent');

        var_dump($star);
        var_dump($all);
        var_dump($only);
        var_dump($exp);
        var_dump($header);
        var_dump($userAgent);
        echo $vip;
    }

    public function upload()
    {
        return view('upload');
    }

    public function uploadFile(Request $request)
    {
        $flag = $request->hasFile('profile');
        // 闪存
        $request->flash();
        if ($flag) $request->file('profile')->move('./upload', '22.jpg');
        return back();
    }

    public function old(Request $request)
    {
        var_dump(old('username'));
    }

    public function cookieDemo(Request $request)
    {
//        \Cookie::queue('name','xxx',30);
//        return response('')->withCookie('age','20',30);
        $name = \Cookie::get('name');
        var_dump($name);
        var_dump($request->cookie('age'));
    }

//    自定义闪存
    public function flash()
    {
        \Session::flash('name', 'klkl');
    }

    public function get_flash()
    {
        echo session('name');
    }

    public function response()
    {
//        echo 123;
//        return 'i love you';
//        返回并设置cookie
//        return response('')->withCookie('age','20',30);
//        return response()->json(['name' => 'wwwx']);
//        return response()->download('./upload/22.jpg');
//        return redirect('/form');
//        return redirect('https://www.baidu.com');
    }

    public function blade()
    {
        return view('admin.user.index', [
            'title' => 'title12344444',
            'username' => '444',
            'page' => '<a href="1.html">1</a><a href="2.html">2</a><a href="3.html">3</a>'
        ]);
    }

    public function page()
    {
        return view('page.index');
    }

    public function cart()
    {
        return view('page.cart');
    }

    public function layout()
    {
        return view('layout.index');
    }

    public function extend()
    {
        return view('layout.extend');
    }

    public function liucheng()
    {
        return view('control.liucheng', [
            'score' => 85,
            'sex' => 0,
            'scorelist' => [
                [
                    'username' => 'iwen',
                    'age' => 20,
                    'score' => 90
                ],
                [
                    'username' => 'kkl',
                    'age' => 19,
                    'score' => 80
                ],
                [
                    'username' => 'glh',
                    'age' => 21,
                    'score' => 70
                ]
            ]
        ]);
    }

    public function sql()
    {
//        $res = DB::select('select * from user ');
//        $res = DB::select('select * from user where user_id > ?', [1]);
//        $res = DB::insert('insert into user (username,age) values("lihao",20)');
//        $res = DB::insert('insert into user (username,age) values(?,?)',["lihao",20]);
//        $res = DB::update('update user set username = "nihao" where user_id = ?', [2]);
//        $res = DB::update('update user set username = ? where user_id = ?', ["nihao", 2]);
//        $res = DB::delete('delete from user where user_id > ?',[1]);
//        $res = DB::statement('create table test(id int primary key auto_increment,name char(40))');
//        $res = DB::statement('drop table test');
//        事务操作
//        DB::beginTransaction();
//        $res = DB::update('update user set username = "nihao" where user_id = ?', [1]);
//        $res1 = DB::update('update money set money = "10" where id = ?', [1]);
//
//        if($res && $res1){
//            DB::commit();
//            echo 777;
//        }else{
//            Db::rollBack();
//            echo 888;
//        }

        // 操作多个数据库
//        $res = DB::connection('slaver-1')->select();

//        $res = DB::table('user')->insert([
//           'username' =>'lihao',
//           'age' => 18,
//        ]);

//        插入多条数据
//        $res = DB::table('user')->insert([
//            [
//                'username' => 'lihao',
//                'age' => 18,
//            ],
//            [
//                'username' => 'iwen',
//                'age' => 17,
//            ], [
//                'username' => 'glh',
//                'age' => 30,
//            ]
//        ]);

//        $res = DB::table('user')->insertGetId(
//            ['username' => 'hjn', 'age' => 18]
//        );

//        $res = DB::table('user')->where('user_id','=',3)->update(['username'=>'gkg']);
//        $res = DB::table('user')->where('user_id','=',3)->delete();
//        $res = DB::table('user')->get();
//        $res = DB::table('user')->first();
//        $res = DB::table('user')->value('username');
//        $res = DB::table('user')->select('username', 'age')->get();
//        $res = DB::table('user')->select('username', 'age')->where("username", "=", "iwen")->get();
//        $res = DB::table('user')->select('username', 'age')
//            ->where("username", "=", "iwen")
//            ->orWhere("age", "=", 18)
//            ->get();
//        $res = DB::table('user')->select('username', 'age')
//            ->whereBetween("age", [18, 20])
//            ->get();
//        $res = DB::table('user')->select('username', 'age')
//            ->whereIn("age", [17, 20])
//            ->get();
//        $res = DB::table('user')->select('user_id','username', 'age')
//            ->orderBy('user_id','desc')
//            ->get();
        $res = DB::table('user')->select('user_id', 'username', 'age')
            ->skip(2)->take(2)
            ->get();
//        echo "<pre/>";
        dd($res);
        echo 123;
    }

    public function func()
    {
//        love();
        $goods = new Goods();
        // 添加
//        $goods->title = '保温杯';
//        $goods->content = '保温杯';
//        $goods->created_at = date('Y-m-d H:i:s');
//        $goods->updated_at = date('Y-m-d H:i:s');
//        $goods->save();

        // 读取
//        $info = $goods->find(13);
//
//        echo $info->title;
//        echo $info['title'];

        // 删除
//        $goods->find(13)->delete();
//        dd($info);

//        $info = $goods->find(12);
//        $info->title = 'woomkd';
//        $info->save();

        $data = $goods->OrderBy('goods_id', 'desc')->where('goods_id', '>', 2)->get();
        dd($data);
        return 'test';
    }

    public function relation()
    {
        $user = new Users();
        $user = $user->find(1);

        //读取详细信息 一对一
//        $detail = $user->userInfo()->first();
//        $detail = $user->userInfo;
//        $detail = Users::find(1)->userInfo()->first();

//        $article = $user->article()->where('id','=',1)->get();

//        $country = $user->country()->first();
//        $country = $user->country;

        $group = $user->group()->get();

//        $article = new Article(['title' => 'test_1', 'content' => 'content_1']); //有问题
//        $article = new Article;
//        $article->title = 'test_1';
//        $article->content = 'content_1';
//        $user -> article()->save($article);


        // 多对多信息添加
//        $user->group()->attach(1);

//        $group = Group::find(1);
//        $user->group()->attach($group);

        // 多对多信息删除
//        $group = Group::find(3);
//        $user->group()->detach($group);
//        $user->group()->detach(2);

        // 信息同步

        $user->group()->sync([1,2, 3]);

        dd($group);
        echo 123;
    }
}
