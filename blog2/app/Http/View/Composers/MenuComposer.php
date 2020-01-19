<?php
namespace App\Http\View\Composers;
use App\Repositories\Eloquent\MenuRepository;
use Illuminate\View\View;

class MenuComposer{
    protected $menu;

    public function __construct(MenuRepository $menu)
    {
        $this->menu = $menu;
    }

    public function compose(View $view){
        $view->with('sidebarMenus',$this->menu->getMenuList());
    }
}
