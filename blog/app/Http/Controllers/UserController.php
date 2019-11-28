<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    //
    public function index(Request $request)
    {
        $users = new User();
        $page = $users->OrderBy('id','desc')->where(function ($query) use ($request){
            $keyword = $request->input('keyword');
            if(!empty($keyword)){
                $query->where('username','like','%'.$keyword.'%');
            }
        })->paginate($request->input('num', 10));
        return view('admin.user.index', [
            'users' => $page,
            'request'=>$request
        ]);
    }

    public function add()
    {
        return view('admin.user.add');
    }

    public function insert(Request $request)
    {
        // 表单验证

        $this->validate($request, [
            'username' => 'required|regex:/\w{8,20}/',
            'email' => 'required|email',
            'password' => 'same:repassword'

        ], [
            'username.required' => '请填写用户名',
            'username.regex' => '用户名规则不正确，请填写8-20位字母数字下划线',
            'email.required' => '邮箱地址不能为空',
            'email.email' => '邮箱地址不正确',
            'password.same' => '两次密码不一致',
        ]);

        $data = $request->all();

        $user = new User();

        $user->username = $request->input('username');
        $user->email = $request->input('email');
        $user->password = Hash::make($request->input('username'));
        $user->intro = $request->input('intro');
        $user->remember_token = $this->str_random(50);
        if ($request->hasFile('profile')) {
            $path = './uploads/' . date('Ymd') . '/';
            $suffix = $request->file('profile')->getClientOriginalExtension();
            $fileName = time() . rand(100000, 999999) . '.' . $suffix;

            $request->file('profile')->move($path, $fileName);
            $user->profile = trim($path . $fileName, '.');
        }

        if ($user->save()) {
            return redirect('/user/index')->with('info', '添加成功');
        } else {
            return back()->with('info', '添加失败');
        }

    }

    public function edit($id){
        $user = new User();
        $info = $user->findOrFail($id);
        return view('admin.user.edit',['user'=>$user]);
        dd($id);
    }
    public function update(Request $request){
        //读取用户的模型
        $user = User::findOrFail($request->input('id'));
        $user -> username = $request->input('username');
        $user -> email = $request->input('email');
        $user -> intro = $request->input('intro');

        if ($request->hasFile('profile')) {
            //文件的存放目录
            $path = './Uploads/'.date('Ymd');
            //获取后缀
            $suffix = $request->file('profile')->getClientOriginalExtension();
            //文件的名称
            $fileName = time().rand(100000, 999999).'.'.$suffix;
            $request->file('profile')->move($path, $fileName);
            $user -> profile = trim($path.'/'.$fileName,'.');
        }
        if($user->save()) {
            return redirect('/user/index')->with('info','更新成功');
        }else{
            return back()->with('info','更新失败');
        }
    }

    /**
     * 删除操作
     */
    public function delete($id)
    {
        //创建模型
        $user = User::findOrFail($id);
        //读取用户的头像信息
        $profile = $user->profile;
        $path = '.'.$profile;
        if(file_exists($path)) {
            unlink($path);
        }
        //删除
        if($user->delete()) {
            return back()->with('info','删除成功');
        }else{
            return back()->with('info','删除失败');
        }
    }

    public function str_random($length)
    {
        $pattern = '1234567890abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLOMNOPQRSTUVWXYZ';
        $key = '';
        for ($i = 0; $i < $length; $i++) {
            $key .= $pattern{mt_rand(0, 35)}; //生成php随机数
        }
        return $key;
    }
}
