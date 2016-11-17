<?php

namespace App\Http\Controllers\Home;

use App\Repositories\Eloquent\AttributeRepository;
use App\Repositories\Eloquent\CartRepository;
use App\Repositories\Eloquent\GoodsRepository;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{

    protected $cart;
    protected $goods;
    protected $attribute;

    public function __construct(CartRepository $cart, GoodsRepository $goods, AttributeRepository $attribute)
    {
        $this->cart = $cart;
        $this->goods = $goods;
        $this->attribute = $attribute;
    }

    public function index()
    {
        $allGoodsList = $this->cart->getGoodsList();
        foreach ($allGoodsList as $item) {
//            $ret = $ga->whereIn('id', explode(',', $item->goods_attr_id))
//                        ->join('attributes', '')
//                        ->get()
            $item->attributes = $item->goods->goodsAttributes()
                ->select('attributes.id', 'attributes.name')
                ->whereIn('goods_attribute.id', explode(',', $item->goods_attr_id))
                ->get();
        }
//        dd($allGoodsList);
        return view('home/shopcart', compact('allGoodsList'));
    }
    public function store(Request $request)
    {

        $cart = $this->cart->create($request->all());
        if ($cart) {
            return response()->json(['status' => true]);
        }else {
            return response()->json(['status' => false, 'error' => '添加失败!请稍后尝试']);
        }
    }

    public function ajaxUpDateCartData($cartID, $goodsNumber)
    {
        if ($goodsNumber != 0) {
            $this->cart->update($cartID, ['number' => $goodsNumber]);
        }else {
            //删除
            if ($this->cart->delete($cartID)) {
                return response()->json(['status' => true]);
            }else {
                return response()->json(['status' => false, 'error' => '删除失败']);
            }
        }
    }
}
