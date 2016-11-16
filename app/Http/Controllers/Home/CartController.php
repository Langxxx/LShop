<?php

namespace App\Http\Controllers\Home;

use App\Repositories\Eloquent\CartRepository;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class CartController extends Controller
{

    protected $cart;

    public function __construct(CartRepository $cart)
    {
        $this->cart = $cart;
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
}
