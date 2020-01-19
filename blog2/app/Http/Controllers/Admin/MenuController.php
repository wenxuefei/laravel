<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\MenuRequest;
use App\Repositories\Eloquent\MenuRepository;

class MenuController extends Controller
{
    protected $menu;

    public function __construct(MenuRepository $menu)
    {
        $this->middleware('check.permission:menu');
        $this->menu = $menu;
    }

    //
    public function index()
    {
        $menusList = $this->menu->getMenuList();
        $menu = $this->menu->findByField('parent_id', 0);
//        return view('admin.menu.list')->with(compact('menu','menusList'));
        return view('admin.menu.list', ['menu' => $menu, 'menusList' => $menusList]);
    }

    public function store(MenuRequest $request)
    {

        $result = $this->menu->create($request->all());
        $this->menu->setMenuToCache();

        $result ? flash('添加菜单成功', 'success') : flash('添加菜单失败', 'error');

        return redirect('admin/menu');
    }


    public function edit($id)
    {
        $menu = $this->menu->editMenu($id);
        return response()->json($menu);
    }

    public function update(MenuRequest $request)
    {
        $this->menu->updateMenu($request);
        return redirect('admin/menu');
    }

    public function destroy($id){
        $this->menu->destroyMenu($id);
        return redirect('admin/menu');
    }
}
