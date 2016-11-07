<?php

use Illuminate\Database\Seeder;

class adminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = new \App\Models\Admin();
        $admin->email = 'admin@admin.com';
        $admin->name = 'admin';
        $admin->password = bcrypt('111111');
        $admin->is_super = 1;
        $admin->save();
    }
}
