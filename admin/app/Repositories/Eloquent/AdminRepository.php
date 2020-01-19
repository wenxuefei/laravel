<?php

namespace App\Repositories\Eloquent;

use App\Repositories\Contracts\AdminInterFace;
use App\Models\Admin;

class AdminRepository implements AdminInterFace
{
    private $admin;

    public function __construct()
    {
        $this->admin = new Admin;
    }

    public function findBy($username)
    {
        return $this->admin->where('username', $username)->first();
    }


    public function getList()
    {

        $username = request('username', '');
        $page = request('page', 1);
        $pageSize = request('pageSize', 10);
        $admin = $this->admin;
        if ($username) {
            $admin = $admin->where('username', 'like', '%' . $username . '%');
        }
        $count = $this->count($admin);
        $admin = $admin->offset($page - 1)->limit($pageSize)->get()->toArray();

        $data = [
            'count' => $count,
            'data' => $admin
        ];
        return api_response(config('responseCode.200'), 200, $data);

    }

    public function count($admin)
    {
        return $admin->count();
    }


    public function save()
    {

        $this->admin->username = request('username');
        $this->admin->password = bcrypt(request('password'));
        $this->admin->mobile = request('phone');
        $this->admin->avatar = request('avatar');
        $this->admin->status = request('status');

        if ($this->admin->save()) {
            return api_response(config('responseCode.200'), 200);
        };

        return api_response(config('responseCode.201'), 201);
    }
}


