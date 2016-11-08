<?php
/**
 * Created by PhpStorm.
 * User: wl
 * Date: 16/11/7
 * Time: 19:14
 */
namespace App\Repositories\Eloquent;

use App\Models\Admin;
use App\Repositories\Eloquent\Repository;

class AdminRepository extends  Repository
{
    public function model()
    {
        return Admin::class;
    }

    public function create(array $attributes)
    {
        $admin =  parent::create($attributes);

        $admin->roles()->sync($attributes['roles']);
        return $admin;
    }

    public function getAdminWithRoles($adminID)
    {
        $admin = $this->with('roles')->find($adminID);
        $admin->roles = $admin->roles->pluck('id')->toArray();
        return $admin;
    }

    public function update($id, array $attributes)
    {
        $admin = $this->find($id);
        $admin->update($attributes);

        //修改关联角色
        $admin->roles()->sync($attributes['roles']);
        return $admin;
    }
}