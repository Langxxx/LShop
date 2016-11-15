<?php
/**
 * Created by PhpStorm.
 * User: wl
 * Date: 16/11/7
 * Time: 19:14
 */
namespace App\Repositories\Eloquent;

use App\Models\Type;
use App\Repositories\Eloquent\Repository;

class TypeRepository extends  Repository
{
    public function model()
    {
        return Type::class;
    }

    public function getTypesForSelect()
    {
        return $this->getAllForSelect('name', 'id');
//        return $this->all()->pluck('name', 'id');
    }

//    public function getTypeAttributesForSelect($typeID)
//    {
//        $attributes = $this->with(['attributes' => function ($query) {
//                return $query->where('attributes.type', '=', '1');
//            }])->find($typeID)
//            ->attributes
//            ->each(function ($item, $key) {
//                $item->for_select_value = explode(',', $item->option_value);
//                return $item;
//            });
////        dd($attributes->toArray());
//        return $attributes;
//    }
}