<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Hash;

use App\Repositories\Eloquent\AdminRepository;
use Jenssegers\Agent\Agent;
use App\Events\AdminLoginEvent;
use App\Http\Requests\LoginRequest;

class LoginController extends Controller
{

    private $adminRepository;

    public function __construct(AdminRepository $adminRepository)
    {
        $this->adminRepository = $adminRepository;
    }

    public function login(LoginRequest $request)
    {
        $username = $request->username;
        $password = $request->password;

        $admin = $this->adminRepository->findBy($username);
        if (!$admin) {
            return api_response(config('responseCode.101'), 101);
        }

        if (!Hash::check($password, $admin->password)) {
            return api_response(config('responseCode.100'), 100);
        }

        if($admin->status != 1){
            return api_response(config('responseCode.105'), 105);
        }

        $credentials = compact('username','password');
        if (!$token = auth('admins')->attempt($credentials)) {
            return api_response(config('responseCode.401'), 401);
        }

        event(new AdminLoginEvent(auth()->user(), new Agent(), $request->ip(), time())); // 登录日志
        return $this->respondWithToken($token);
    }

    protected function respondWithToken($token)
    {
        $data = [
            'access_token' => $token,
            'token_type' => 'Bearer',
            'expires_in' => auth('admins')->factory()->getTTL() * 60
        ];
        return api_response(config('responseCode.200'), 200, $data);
    }

    public function refresh()
    {
        return $this->respondWithToken(auth('admins')->refresh());
    }

    public function logout()
    {
        auth()->logout();

        return api_response(config('responseCode.200'), 200);
    }


}

