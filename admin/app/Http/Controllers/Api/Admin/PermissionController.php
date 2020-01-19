<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use Illuminate\Http\Request;
use App\Repositories\Eloquent\AdminRepository;
class PermissionController extends Controller
{
    private $adminRepository;
    public function __construct(AdminRepository $admin)
    {
        $this->adminRepository = $admin;
    }

    public function userList(){
        return $this->adminRepository->getList();
    }

    public function addUser(UserRequest $request){
        return $this->adminRepository->save();
    }


}
