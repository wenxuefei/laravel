<?php

use Illuminate\Database\Seeder;
use App\Models\Menu;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $index = new Menu;
        $index->name = "控制台";
        $index->parent_id = 0;
        $index->icon = "fa fa-dashboard";
        $index->slug = "admin.systems.index";
        $index->url = "admin";
        $index->save();
        /**
         * -------------------------------------------------
         * 博客管理
         * -------------------------------------------------
         */
        $blog = new Menu;
        $blog->name = "博客管理";
        $blog->parent_id = 0;
        $blog->icon = "fa fa-diamond";
        $blog->slug = "admin.systems.blog";
        $blog->url = "admin/cate*,admin/article*,admin/tag*";
        $blog->save();

        $categories = new Menu;
        $categories->name = "分类管理";
        $categories->parent_id = $blog->id;
        $categories->icon = "fa fa-cloud";
        $categories->slug = "admin.categories.list";
        $categories->url = "admin/cate";
        $categories->save();

        $article = new Menu;
        $article->name = "文章管理";
        $article->parent_id = $blog->id;
        $article->icon = "fa fa-file-text";
        $article->slug = "admin.articles.list";
        $article->url = "admin/article";
        $article->save();

        $tags = new Menu;
        $tags->name = "标签管理";
        $tags->parent_id = $blog->id;
        $tags->icon = "fa fa-tags";
        $tags->slug = "admin.tags.list";
        $tags->url = "admin/tag";
        $tags->save();
        /**
         * -------------------------------------------------
         * 系统管理
         * -------------------------------------------------
         */
        $system = new Menu;
        $system->name = "系统管理";
        $system->parent_id = 0;
        $system->icon = "fa fa-cog";
        $system->slug = "admin.systems.manage";
        $system->url = "admin/role*,admin/permission*,admin/user*,admin/menu*,admin/log-viewer*";
        $system->save();

        $user = new Menu;
        $user->name = "用户管理";
        $user->parent_id = $system->id;
        $user->icon = "fa fa-users";
        $user->slug = "admin.users.list";
        $user->url = "admin/user";
        $user->save();

        $role = new Menu;
        $role->name = "角色管理";
        $role->parent_id = $system->id;
        $role->icon = "fa fa-male";
        $role->slug = "admin.roles.list";
        $role->url = "admin/role";
        $role->save();

        $permission = new Menu;
        $permission->name = "权限管理";
        $permission->parent_id = $system->id;
        $permission->icon = "fa fa-paper-plane";
        $permission->slug = "admin.permissions.list";
        $permission->url = "admin/permission";
        $permission->save();

        $log = new Menu;
        $log->name = "系统日志";
        $log->parent_id = $system->id;
        $log->icon = "fa fa-file-text-o";
        $log->slug = "admin.logs.all";
        $log->url = "admin/log-viewer";
        $log->save();

        $menu = new Menu;
        $menu->name = "菜单管理";
        $menu->parent_id = $system->id;
        $menu->icon = "fa fa-navicon";
        $menu->slug = "admin.menus.list";
        $menu->url = "admin/menu";
        $menu->save();
    }
}
