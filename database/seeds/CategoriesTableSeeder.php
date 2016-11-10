<?php

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $root = Category::create(['name' => 'Root']);

        for ($i = 0; $i < 4; $i++) {
            $child1 = $root->children()->create(['name' => '测试分类'. $i]);
            for ($j = 0; $j < 3; $j++) {
                $child1_1 = $child1->children()->create(['name' => '测试分类'. $i . '-' . $j]);
                for ($k = 0; $k < 3; $k++) {
                    $child1_1->children()->create(['name' => '测试分类'. $i . '-' . $j . '-' . $k]);
                }
            }
        }
    }
}
