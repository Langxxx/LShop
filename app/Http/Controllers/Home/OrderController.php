<?php

namespace App\Http\Controllers\Home;

use App\Repositories\Eloquent\AttributeRepository;
use App\Repositories\Eloquent\CartRepository;
use App\Repositories\Eloquent\GoodsRepository;
use App\Repositories\Eloquent\OrderRepository;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    protected $cart;
    protected $goods;
    protected $attribute;
    protected $order;

    public function __construct(CartRepository $cart,
                                GoodsRepository $goods,
                                AttributeRepository $attribute,
                                OrderRepository $order)
    {
        $this->cart = $cart;
        $this->goods = $goods;
        $this->attribute = $attribute;
        $this->order = $order;
    }

    public function pay($cartIDs)
    {
        $allGoodsList = $this->cart->findWhereIn('id', explode(',', $cartIDs))->get();
        foreach ($allGoodsList as $item) {

            $item->attributes = $item->goods->goodsAttributes()
                ->select('attributes.id', 'attributes.name')
                ->whereIn('goods_attribute.id', explode(',', $item->goods_attr_id))
                ->get();
        }
        return view('home.pay', compact('allGoodsList'));
    }

    public function create(Request $request, $carIDs)
    {
        $ret = $this->order->create($request->all());
        //清空购物车
        if ($ret['status']) {
            $this->cart->findWhereIn('id', explode(',', $carIDs))->delete();
        }
        return response()->json($ret);
    }

    public function success()
    {
        return view('home.orderSuccess');
    }
}
