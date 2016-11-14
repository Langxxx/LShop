<?php
/**
 * Created by PhpStorm.
 * User: wl
 * Date: 16/11/7
 * Time: 19:14
 */
namespace App\Repositories\Eloquent;

use App\Models\Category;
use App\Repositories\Eloquent\Repository;

class CategoryRepository extends  Repository
{
    public function model()
    {
        return Category::class;
    }

    public function __get($name)
    {
        // TODO: Implement __get() method.
        if ($name == 'model') {
            return $this->model;
        }
    }

    public function allLeaves()
    {
        return $this->model->allLeaves();
    }

    public function getAllCategoriesWithParentName()
    {
        $cats = $this->model->root()->descendants()->with('parent');
        return $cats;
    }


    public function getCategoriesForSelect()
    {
//        $cats =  $this->all()->pluck('name', 'id');
        $cats = $this->getAllForSelect('name', 'id');
        return $cats;
    }

    public function create(array $attributes)
    {
        $parent = $this->model->find($attributes['parent_id']);
        return $parent->children()->create($attributes);
    }

    public function find($id, $columns = ['*'])
    {
        $cat = $this->model->find($id);
        return $cat;
    }

    public function update($id, array $attributes)
    {
        $cat = $this->find($id);
        if ($cat->parent_id != $attributes['parent_id']) {
            //更改了父级分类
            $newParent = $this->model->find($attributes['parent_id']);
            $cat->makeChildOf($newParent);
        }
        return $cat->update($attributes);
    }

}