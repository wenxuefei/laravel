<?php

namespace App\Repositories\Eloquent;

use App\Repositories\Eloquent\Repository;
use App\Models\Menu;
use Illuminate\Container\Container as App;
use Illuminate\Support\Facades\Cache;

class MenuRepository extends Repository
{
    private $menusList;

    public function __construct(App $app)
    {
        parent::__construct($app);
        $this->menusList = config('admin.globals.cache.menusList');
    }

    public function model()
    {
        // TODO: Implement model() method.

        return Menu::class;
    }


    public function sortMenu($menus, $pid = 0)
    {
        $arr = [];
        if (empty($menus)) return '';

        foreach ($menus as $k => $v) {
            if ($v['parent_id'] == $pid) {
                $arr[$k] = $v;
                $arr[$k]['child'] = self::sortMenu($menus, $v['id']);
            }
        }

        return $arr;
    }

    public function setMenuToCache()
    {
        $menus = $this->model->orderBy('sort', 'desc')->get()->toArray();

        $menusList = '';

        if ($menus) {
            $menusList = $this->sortMenu($menus);

//            foreach ($menusList as $k => $v) {
//                if ($v['child']) {
//                    $sort = array_column($v['child'], 'sort');
//                    array_multisort($sort, SORT_DESC, $v['child']);
//                }
//            }
            Cache::put($this->menusList, $menusList);
        }


        return $menusList;
    }

    public function getMenuList()
    {
        if (Cache::has($this->menusList)) {
            return Cache::get($this->menusList);
        } else {
            return $this->setMenuToCache();
        }

    }

    public function editMenu($id)
    {
        $menu = $this->model->find($id);

        if ($menu) {
            $menu['update'] = url('admin/menu/' . $id);
            $menu['msg'] = '加载成功';
            $menu['status'] = 'true';

            return $menu;
        }
        return ['msg' => '加载失败', 'status' => false];
    }

    public function updateMenu($request)
    {
        $menu = $this->model->find($request->id);


        if ($menu) {
            $isUpdate = $menu->update($request->all());
//            dump($request->all());
//            dd($menu->update($request->all()));

            if ($isUpdate) {
                $this->setMenuToCache();
                flash('修改菜单成功', 'success');
                return true;
            }
            flash('修改菜单失败', 'error');
            return false;

        }
        abort(404, '菜单数据找不到');
    }

    public function destroyMenu($id){
        $isDelete = $this->model->destroy($id);
        if($isDelete){
            $this->setMenuToCache();
            flash('删除菜单成功', 'success');
            return true;
        }
        flash('删除菜单失败', 'error');
        return false;
    }
}
