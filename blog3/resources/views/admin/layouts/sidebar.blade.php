<!-- sidebar menu -->
@inject('menus','App\Repositories\Presenters\MenuPresenter')
<div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
    <div class="menu_section">
        <h3>General</h3>
        <ul class="nav side-menu">
            {!! $menus->sidebarMenus($sidebarMenus) !!}
        </ul>
    </div>
</div>
<!-- /sidebar menu -->

