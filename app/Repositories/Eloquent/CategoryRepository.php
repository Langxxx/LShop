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
use Illuminate\Support\Facades\DB;

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
//        $cats = $this->getAllForSelect('name', 'id');
        $cats = $this->model
            ->root()
            ->descendantsAndSelf()
            ->with('parent')
            ->get()
            ->each(function($item, $key) {
                $item->name = str_repeat('--', $item->depth) . $item->name;
            })
            ->pluck('name', 'id');
        return $cats;
    }

    public function create(array $attributes)
    {
        if (isset($attributes['attr_id'])) {
            $attributes['search_attr_id'] = implode(',', array_unique($attributes['attr_id']));
        }

        unset($attributes['type_id']);
        unset($attributes['attr_id']);

        $parent = $this->model->find($attributes['parent_id']);
        return $parent->children()->create($attributes);
    }

    public function find($id, $columns = ['*'])
    {
        $cat = parent::find($id);
//        $cat->search_types = DB::table('attributes')->select()
//            ->whereIn('id', explode(',', $cat->search_attr_id))
//            ->groupBy('type_id')
//            ->get();
//        dd($cat->search_types);
//        foreach ($cat->search_types as $search_type) {
//
//        }
        return $cat;
    }

    public function update($id, array $attributes)
    {
        if (isset($attributes['attr_id'])) {
            $attributes['search_attr_id'] = implode(',', array_unique($attributes['attr_id']));
        }

        unset($attributes['type_id']);
        unset($attributes['attr_id']);

        $cat = $this->find($id);
        if ($cat->parent_id != $attributes['parent_id']) {
            //更改了父级分类
            $newParent = $this->model->find($attributes['parent_id']);
            $cat->makeChildOf($newParent);
        }
        return $cat->update($attributes);
    }

    public function tree()
    {
        return $this->model->root()->getDescendants(3, array('id', 'parent_id', 'name'))->toHierarchy();
    }
}