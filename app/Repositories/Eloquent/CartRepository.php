<?php
/**
 * Created by PhpStorm.
 * User: wl
 * Date: 16/11/7
 * Time: 19:14
 */
namespace App\Repositories\Eloquent;

use App\Models\Cart;
use App\Repositories\Eloquent\Repository;

class CartRepository extends  Repository
{
    public function model()
    {
        return Cart::class;
    }
}