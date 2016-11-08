<?php
/**
 * Created by PhpStorm.
 * User: wl
 * Date: 16/11/7
 * Time: 19:14
 */
namespace App\Repositories\Eloquent;

use App\Models\Role;
use App\Repositories\Eloquent\Repository;

class RoleRepository extends  Repository
{
    public function model()
    {
        return Role::class;
    }

    public function getRolesWithPermissionsName()
    {
        $roles = $this->with('perms')->get();
        foreach ($roles as $role) {
            $permsDisplayName = '';
            foreach ($role->perms as $perm) {
                $permsDisplayName .= $perm->display_name . ',';
            }

            $role->permsDisplayName = $permsDisplayName != '' ? rtrim($permsDisplayName, ',') : '无';
        }
        return $roles;
    }

    public function getRoleWithPermission($roleID)
    {
        $role= $this->with('perms')->find($roleID);
        $role->permissionIDs = $role->perms->pluck('id')->toArray();
        return $role;
    }

    public function create(array $attributes)
    {
        $role =  parent::create($attributes);
        //关联权限
        $role->perms()->sync($attributes['role_permission']);
        return $role;
    }

    public function update($id, array $attributes)
    {
        //找到当前角色
        $role = $this->find($id);
        $role->update($attributes);
        //修改关联权限
        $role->perms()->sync($attributes['role_permission']);
        return $role;
    }

    public function delete($id)
    {
        $role = $this->find($id);
        //如果当前角色下有管理员不能删除
        if(!$role->users()->get()->isEmpty()) {
            return ['status' => false, 'error' => '有某个管理员属于当前角色!'];
        }

        //删除权限关联
        $role->perms()->detach();
        if (parent::delete($id)) {
            return ['status' => true];
        }
    }
}