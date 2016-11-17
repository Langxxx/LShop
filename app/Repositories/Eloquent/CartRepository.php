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

    public function getGoodsList()
    {
        return $this->model
            ->where('user_id', '=', auth()->user()->id)
            ->select('id', 'number', 'goods_attr_id', 'goods_id')
            ->with('goods')
            ->get();
    }
}