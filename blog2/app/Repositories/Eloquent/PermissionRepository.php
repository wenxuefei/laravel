<?php

namespace App\Repositories\Eloquent;

use App\Repositories\Eloquent\Repository;
use Spatie\Permission\Models\Permission;

class PermissionRepository extends Repository
{
    public function model()
    {
        return Permission::class;
    }

    public function createPermission($attributes)
    {
        $result = $this->create($attributes);

        $result ? flash('添加权限成功', 'success') : flash('添加权限失败', 'error');

        return $result;
    }

    public function ajaxIndex()
    {

        $draw = request('draw', 1);
        $start = request('start', config('admin.global.list.start'));
        $length = request('length', config('admin.global.list.length'));

        $order['name'] = request('columns.' . request('order.0.column', 0) . '.name');
        $order['dir'] = request('order.0.dir', 'asc');

        $search['value'] = request('search.value','');
        $search['regex'] = request('search.regex',false);

        $permission = $this->model;
        if($search['value']){
            if ($search['regex']){
                $permission = $permission->where('name','like','%'.$search['value'].'%')->orwhere('guard_name','like','%'.$search['value'].'%');
            }else{
                $permission = $permission->where('name',$search['value']);
            }
        }
        $count = $permission->count();
        $permission = $permission->orderBy($order['name'], $order['dir']);
        $permissions = $permission->offset($start)->limit($length)->get()->toArray();

        return [
            'draw' => $draw,
            'recordsTotal' => $count,
            'recordsFiltered' => $count,
            'data' => $permissions
        ];

    }
}
