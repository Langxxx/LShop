<?php
/**
 * Created by PhpStorm.
 * User: wl
 * Date: 16/11/7
 * Time: 19:14
 */
namespace App\Repositories\Eloquent;

use App\Models\Permission;
use App\Repositories\Eloquent\Repository;

class PermissionRepository extends  Repository
{
    public function model()
    {
        return Permission::class;
    }

    public function getPermissionsForSelect($needFirstSelect = true, $firstSelectName = '--顶级权限--')
    {
        $temp = $this->all(['id', 'pid', 'display_name'])->toArray();

        $tree = $this->getTree($temp);
        if ($needFirstSelect) {
            array_unshift($tree, ['display_name' => $firstSelectName, 'id' => '0']);
        }

        $permissions = array();
        foreach ($tree as $item) {
            $permissions[$item['id']] = $item['display_name'];
        }

        return $permissions;
    }

    protected function getTree($array, $pid = 0, $level = 0, $repeatStr = '----', $isClear = true)
    {
        static $ret = array();
        if ($isClear) {
            $ret = [];
        }
        foreach ($array as $key => $item) {

            if ($item['pid'] == $pid) {
                $item['level'] = $level;
                $item['display_name'] = str_repeat($repeatStr, $level) . $item['display_name'];
                $ret[] = $item;
                $this->getTree($array, $item['id'], $level+1, $repeatStr, false);
            }
        }
        return $ret;
    }

    public function delete($permissionId)
    {
        $this->model->roles()->detach();
        if (parent::delete($permissionId)) {
            return ['status' => true];
        }else {
            return ['status' => false];
        }
    }

    public function getCurrentUserAllPermissions()
    {
        $admin = auth()->guard('admin')->user();
        $column = ['id', 'pid', 'name', 'display_name', 'is_menu'];

        if ($admin->is_super) {
            //超级管理员取得所有权限
            $menuPermission = $this->all($column)->filter(function ($item) {
                return $item->is_menu == 1;
            });

            $tree = $this->getTree($menuPermission, 0, 0, '');
            return $tree;
        }else {
            //获得当前管理员的角色
            $roles = $admin->roles()->with(['perms' => function($query) use($column) {
                $query->select($column);
            }])->get();
            $menuPermission = $roles->pluck('perms')->flatten()->filter(function ($item) {
                return $item->is_menu == 1;
            })->unique(function ($item) {
                return $item->name;
            });

            $tree = $this->getTree($menuPermission, 0, 0, '');
            return $tree;
        }
    }
}