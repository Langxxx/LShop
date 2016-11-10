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
}