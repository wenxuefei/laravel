<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // 重置角色和权限的缓存
        app()['cache']->forget('spatie.permission.cache');

        /*
         * 系统管理
         * */
        Permission::create(['name' => 'admin.systems.manage']);

        /*
         * 登录后台权限
         * */
        Permission::create(['name' => 'admin.systems.login']);
        Permission::create(['name' => 'admin.systems.index']);
        Permission::create(['name' => 'admin.logs.all']);
        Permission::create(['name' => 'admin.logs.list']);


        /**
         * 显示菜单列表
         */
        Permission::create([
            'name' => 'admin.menus.list',
        ]);
        /**
         * 创建菜单
         */
        Permission::create([
            'name' => 'admin.menus.create',
        ]);
        /**
         * 删除菜单
         */
        Permission::create([
            'name' => 'admin.menus.delete',
        ]);
        /**
         * 修改菜单
         */
        Permission::create([
            'name' => 'admin.menus.edit',
        ]);

        /////////////
        //角色管理 //
        ////////////
        /**
         * 显示角色列表
         */
        Permission::create([
            'name' => 'admin.roles.list',
        ]);
        /**
         * 创建角色
         */
        Permission::create([
            'name' => 'admin.roles.create',
        ]);
        /**
         * 删除角色
         */
        Permission::create([
            'name' => 'admin.roles.delete',
        ]);
        /**
         * 修改角色
         */
        Permission::create([
            'name' => 'admin.roles.edit',
        ]);
        /**
         * 通过角色
         */
        Permission::create([
            'name' => 'admin.roles.audit',
        ]);
        /**
         * 禁用角色
         */
        Permission::create([
            'name' => 'admin.roles.trash',
        ]);
        /**
         * 恢复角色
         */
        Permission::create([
            'name' => 'admin.roles.undo',
        ]);
        /**
         * 查看角色权限
         */
        Permission::create([
            'name' => 'admin.roles.show',
        ]);
        /////////////
        //权限管理 //
        ////////////
        /**
         * 显示权限列表
         */
        Permission::create([
            'name' => 'admin.permissions.list',

        ]);
        /**
         * 创建权限
         */
        Permission::create([
            'name' => 'admin.permissions.create',

        ]);
        /**
         * 删除权限
         */
        Permission::create([
            'name' => 'admin.permissions.delete',
        ]);
        /**
         * 修改权限
         */
        Permission::create([
            'name' => 'admin.permissions.edit',
        ]);
        /**
         * 禁用权限
         */
        Permission::create([
            'name' => 'admin.permissions.trash',
        ]);
        /**
         * 恢复权限
         */
        Permission::create([
            'name' => 'admin.permissions.undo',
        ]);
        /**
         * 通过权限
         */
        Permission::create([
            'name' => 'admin.permissions.audit',
        ]);
        /////////////
        //用户管理 //
        ////////////
        /**
         * 显示用户列表
         */
        Permission::create([
            'name' => 'admin.users.list',
        ]);
        /**
         * 创建用户
         */
        Permission::create([
            'name' => 'admin.users.create',
        ]);
        /**
         * 删除用户
         */
        Permission::create([
            'name' => 'admin.users.delete',
        ]);
        /**
         * 修改用户
         */
        Permission::create([
            'name' => 'admin.users.edit',
        ]);
        /**
         * 通过用户
         */
        Permission::create([
            'name' => 'admin.users.audit',
        ]);
        /**
         * 禁用用户
         */
        Permission::create([
            'name' => 'admin.users.trash',
        ]);
        /**
         * 恢复用户
         */
        Permission::create([
            'name' => 'admin.users.undo',
        ]);
        /**
         * 查看用户信息
         */
        Permission::create([
            'name' => 'admin.users.show',
        ]);
        /**
         * 修改用户密码
         */
        Permission::create([
            'name' => 'admin.users.reset',
        ]);


        // 创建角色并赋予已创建的权限
        $role = Role::create(['name' => 'user']);
        /**
         * 普通用户赋予一般权限
         */
        $loginBackendPer = Permission::findByName('admin.systems.login');
        $role->givePermissionTo($loginBackendPer);


        $adminRole = Role::create(['name' => 'admin']);
        /*管理员初始化所有权限*/
        $all_permissions = Permission::all();
        foreach ($all_permissions as $all_permission){
            $adminRole->givePermissionTo($all_permission);
        }
    }
}
