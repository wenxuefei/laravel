<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function index(){
        return view('admin.login.login');
    }
    public function login(Request $request){


        $this->validate($request, [
            'username' => 'required|min:5',
            'password' => 'required|min:5|max:10',
        ]);


        $user = ['username'=>$request->get('username'),'password'=>$request->get('password')];

        if (auth()->guard('admin')->attempt($user)) {
            return redirect('/admin');
        }
        return redirect()->back()->withErrors('用户名密码不正确');
    }
    public function logout(){
        auth()->guard('admin')->logout();
        return redirect('/admin/login');
    }
}
