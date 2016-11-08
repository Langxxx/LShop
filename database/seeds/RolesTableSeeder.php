<?php

use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\Permission;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissionManager = Role::create([
            'name' => 'permissionManager',
            'display_name' => '权限管理员'
        ]);
        $permission = Permission::where('name', 'admin.permission')->first();
        $permissionManager->attachPermission($permission);
    }
}
