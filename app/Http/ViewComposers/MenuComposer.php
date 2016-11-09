<?php
/**
 * Created by PhpStorm.
 * User: wl
 * Date: 16/11/8
 * Time: 22:30
 */
namespace App\Http\ViewComposers;

use App\Repositories\Eloquent\PermissionRepository;
use Carbon\Carbon;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Cache;

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
//        if (Cache::has('admin.globals.cache.menuList')) {
//            return Cache::get('admin.globals.cache.menuList');
//        }

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
//        $expiresAt = Carbon::now()->addMinutes(1);
//        Cache::put('admin.globals.cache.menuList', $html, $expiresAt);

        return $html;
    }
}