<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function index()
    {
        return view('home.register.index');
    }

    public function register(Request $request)
    {
        $this->validate($request, [
            'username' => 'required|min:3|unique:users,username',
            'email' => 'required|unique:users,email|email',
            'password' => 'required|min:5|max:10|confirmed',
        ]);

        $username = $request->get('username');
        $email = $request->get('email');
        $password = bcrypt($request->get('password'));

        $user = new User();
        $user = $user->create(compact('username','email','password'));

        return redirect('/login');
    }
}
