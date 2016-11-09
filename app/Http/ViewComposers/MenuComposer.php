<?php
/**
 * Created by PhpStorm.
 * User: wl
 * Date: 16/11/8
 * Time: 22:30
 */
namespace App\Http\ViewComposers;

use App\Repositories\Eloquent\PermissionRepository;
use Illuminate\Contracts\View\View;

class MenuComposer
{
    protected  $permission;

    public function __construct(PermissionRepository $permission)
    {
        $this->permission = $permission;
    }

    public function compose(View $view)
    {
        $html = $this->getMenu();
        $view->with('slidebarMenus', $html);
    }

    protected function getMenu()
    {
        $menuPermissions = $this->permission->getCurrentUserAllPermissions();

        $html = '';
        foreach ($menuPermissions as $permission) {
            $html .= '<li>';
            if ($permission->level == 0) {
                $html .= '<a href="#"><i class="fa fa-user"></i> ' . $permission->display_name .
                    '<span class="fa arrow"></span></a>';
                $html .= '<ul class="nav nav-second-level">';
                foreach ($menuPermissions as $subPerm) {
                    if ($subPerm->pid == $permission->id) {
                        $html .= '<li><a href="' . route($subPerm->name) . '">' .
                            $subPerm->display_name . '</a></li>';
                    }
                }
                $html .= '</ul>';
            }
            $html .= '</li>';
        }

        return $html;
    }
}