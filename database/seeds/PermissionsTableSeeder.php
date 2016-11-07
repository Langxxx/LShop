<?php

use Illuminate\Database\Seeder;
use App\Models\Permission;
class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permission = Permission::create([
            'name' => 'admin.permission',
            'display_name' => '权限管理',
            'description' => '权限管理,所有权限管理的基础',
            'pid' => 0,
        ]);
        $permissionID = $permission->id;
        Permission::create([
            'name' => 'admin.permission.index',
            'display_name' => '权限列表',
            'description' => '权限列表',
            'pid' => $permissionID,
        ]);

        Permission::create([
            'name' => 'admin.permission.create',
            'display_name' => '创建权限的界面',
            'description' => '创建权限的界面',
            'pid' => $permissionID,
        ]);
        Permission::create([
            'name' => 'admin.permission.store',
            'display_name' => '创建权限',
            'description' => '创建权限',
            'pid' => $permissionID,
        ]);
        Permission::create([
            'name' => 'admin.permission.edit',
            'display_name' => '修改权限的界面',
            'description' => '修改权限的界面',
            'pid' => $permissionID,
        ]);
        Permission::create([
            'name' => 'admin.permission.update',
            'display_name' => '更新权限',
            'description' => '更新权限',
            'pid' => $permissionID,
        ]);
        Permission::create([
            'name' => 'admin.permission.destroy',
            'display_name' => '删除权限',
            'description' => '删除权限',
            'pid' => $permissionID,
        ]);

        Permission::create([
            'name' => 'admin.goods',
            'display_name' => '商品管理',
            'description' => '商品管理',
            'pid' => 0,
        ]);

    }
}
