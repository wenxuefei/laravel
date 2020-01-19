<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function index()
    {
        return view('home.login.index');
    }

    public function login(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required|min:5|max:10',
            'is_remember' => 'integer'
        ]);

        $user = ['email'=>$request->get('email'),'password'=>$request->get('password')];

        if (auth()->attempt($user, $request->filled('is_remember'))) {
            return redirect('/article');
        }
        return redirect()->back()->withErrors('邮箱密码不正确');
    }

    public function logout()
    {
        auth()->logout();
        return redirect('/login');
    }
}
