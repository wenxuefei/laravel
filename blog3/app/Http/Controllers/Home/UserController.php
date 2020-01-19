<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function setting()
    {
        return 99;
    }

    public function settingStore()
    {
        return 220;
    }

    public function show($id)
    {
        $user = new User();
        $user = $user->withCount(['star', 'fans', 'articles'])->find($id);

        $posts = $user->articles()->orderBy('created_at', 'desc')->take(10)->get();
        $fans = $user->star;
        $suser = User::whereIn('id', $fans->pluck('star_id'))->withCount(['star', 'fans', 'articles'])->get();

        $fans = $user->fans;
        $fuser = User::whereIn('id', $fans->pluck('fan_id'))->withCount(['star', 'fans', 'articles'])->get();

        return view('home.user.show', ['user' => $user, 'posts' => $posts, 'suser' => $suser, 'fuser' => $fuser]);
    }

    public function fan(Request $request,$id)
    {
        $user = auth()->user();
        $user->doFan($id);
        return ['error' => 0, 'msg' => ''];
    }

    public function unFan(Request $request,$id)
    {

        $user = auth()->user();

        $user->doUnFan($id);
        return ['error' => 0, 'msg' => ''];
    }
}
