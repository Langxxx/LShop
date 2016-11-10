<?php
/**
 * Created by PhpStorm.
 * User: wl
 * Date: 16/11/7
 * Time: 19:14
 */
namespace App\Repositories\Eloquent;

use App\Models\Attribute;
use App\Repositories\Eloquent\Repository;

class AttributeRepository extends  Repository
{
    public function model()
    {
        return Attribute::class;
    }

//    public function create(array $attributes)
//    {
//        $attri =  parent::create($attributes);
//        $attri->
//    }
}