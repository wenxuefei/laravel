<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use Dingo\Api\Http\Request;
use Illuminate\Support\Facades\Storage;

class HomeController extends Controller
{
    public function userInfo()
    {
        return api_response(config('responseCode.200'), 200, auth()->user());
    }

    public function upload(Request $request)
    {

        if ($request->hasFile('file')) {
            $filename = $request->file('file')->store('');
            $suffix = $request->file('file')->getClientOriginalExtension();
            $rule = ['jpg', 'png', 'gif'];

            if (!in_array($suffix, $rule)) {
                return api_response(config('responseCode.202'), 202);
            }

            $path = './avatars/' . date('Ymd') . '/';

            $request->file('file')->move($path, $filename);
            return api_response(config('responseCode.200'), 200, $path . $filename);
        }
        return api_response(config('responseCode.201'), 201);
    }
}
