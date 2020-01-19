<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Repositories\Contracts\UserInterface;
use UserRepository;

use App\Repositories\Eloquent\UserRepository as UserRepo;


class HomeController extends Controller
{
    private $user;
    private $userRepo;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(UserInterface $user,UserRepo $userRepo)
    {
        $this->user = $user;
        $this->userRepo = $userRepo;
//        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
//        $role = Role::create(['name' => 'writer']);  // 创建角色
//        $permission = Permission::create(['name' => 'edit articles']);// 创建权限
//        $user = new User();
//        $user->givePermissionTo('edit articles');

//        $u = $user->find(3);
//        $u->assignRole('writer');

//        $user = $this->user->findBy(1);
//        $user = UserRepository::findBy(1);
//        $user = $this->userRepo->findBy(1);
//        dd($user->toArray());
        return  123;
//        return view('home');
    }
}
