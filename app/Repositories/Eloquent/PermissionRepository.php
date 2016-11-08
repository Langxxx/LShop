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

    protected function getTree($array, $pid = 0, $level = 0)
    {
        static $ret = array();

        foreach ($array as $key => $item) {
            if ($item['pid'] == $pid) {
                $item['level'] = $level;
                $item['display_name'] = str_repeat('----', $level) . $item['display_name'];
                $ret[] = $item;
                $this->getTree($array, $item['id'], $level+1);
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
}