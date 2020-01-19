<?php

namespace App\Repositories\Presenters;

use http\Url;

class MenuPresenter
{
    public function getMenu($menus)
    {
        $options = "<option value='0'>顶级菜单</option>>";
        if ($menus) {

            foreach ($menus as $menu) {
                $options .= "<option value='" . $menu->id . "'>" . $menu->name . "</option>>";
            }

        }

        return $options;
    }

    public function getMenuList($menus)
    {
        if ($menus) {
            $item = '';

            foreach ($menus as $v) {
                $item .= $this->getMenuItem($v['id'], $v['name'], $v['child']);
            }

            return $item;
        }

        return '暂无数据';
    }

    public function getMenuItem($id, $name, $child, $flag = true)
    {
        $item = '<li class="dd-item dd3-item" data-id="' . $id . '"><div class="dd-handle dd3-handle"></div><div class="dd3-content">' . $name . $this->getActionButton($id, $flag) . '</div>';

        if ($child) {
            return $item .= $this->getMenuListHandle($id, $name, $child);
        }

        return $item .= '</li>';
    }

    public function getMenuListHandle($id, $name, $child)
    {
        $handle = '<ol class="dd-list">';

        foreach ($child as $v) {
            $handle .= $this->getMenuItem($v['id'], $v['name'], $v['child'], $flag = false);
        }

        return $handle .= '</ol>';
    }

    public function getActionButton($id, $flag)
    {
        $action = '<div class="pull-right action-buttons">';

        if ($flag) {
            $action .= '<a href="javascript:;" data-pid="' . $id . '" class="btn-xs createMenu"
                                               data-toggle="tooltip" data-original-title="添加" data-placement="top"><i
                                                    class="fa fa-plus"></i></a>';
        }
        $url = url('admin/menu/' . $id . '/edit');

        $action .= '<a href="javascript:;" data-href="' . $url . '" class="btn-xs editMenu"
                                               data-toggle="tooltip" data-original-title="编辑" data-placement="top"><i
                                                    class="fa fa-pencil"></i></a>';
        $action .= '<a href="javascript:;" data-id="' . $id . '" class="btn-xs destroyMenu"
                                               data-original-title="删除" data-toggle="tooltip" data-placement="top"><i
                                                    class="fa fa-trash"></i>';

        $c = csrf_token();
        $url_delete = Url('admin/menu/' . $id);
        $action .= '<form action="' . $url_delete . '" method="POST" name="delete_item' . $id . '" style="display:none">
                                                    <input type="hidden" name="_method" value="delete"><input
                                                        type="hidden" name="_token" value="' . $c . '"></form>
                                            </a>';
        $action .= '</div>';

        return $action;
    }

    public function sidebarMenus($menus)
    {
        $html = '';
        if ($menus) {
            foreach ($menus as $menu) {
                if (auth()->user()->can($menu['slug'])) {
                    $html .= '<li class="' . active_class(if_uri_pattern(explode(',', $menu['heightlight_url']))) . '">';
                    if ($menu['child']) {
                        $html .= '<a><i class="' . $menu['icon'] . '"></i> ' . $menu['name'] . '<span class="fa fa-chevron-down"></span></a>' . $this->getSideMenu($menu['child'], $menu['heightlight_url']);
                    } else {
                        $html .= '<a href="/' . $menu['url'] . '"><i class="' . $menu['icon'] . '"></i> ' . $menu['name'] . '</a>';
                    }

                    $html .= '</a></li>';
                }

            }
        }

        return $html;
    }

    public function getSideMenu($childMenu = '', $url = '')
    {
        $html = '';
        if ($childMenu) {

            $html .= '<ul class="nav child_menu" style="display:' . active_class(if_uri_pattern(explode(',',$url)), 'block', 'none') . '">';
            foreach ($childMenu as $child) {

                if (auth()->user()->can($child['slug'])) {

                    $html .= '<li class="' . active_class(if_uri_pattern([$child['heightlight_url']]), 'current-page') . '"><a href="/' . $child['url'] . '">' . $child['name'] . '</a></li>';
                }
            }

            $html .= '</ul>';
        }

        return $html;
    }


}
