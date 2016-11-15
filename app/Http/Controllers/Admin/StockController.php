<?php

namespace App\Http\Controllers\Admin;

use App\Repositories\Eloquent\GoodsRepository;
use App\Repositories\Eloquent\TypeRepository;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class StockController extends BaseController
{
    protected $goods;
    protected $type;

    public function __construct(GoodsRepository $goods, TypeRepository $type)
    {
        parent::__construct();
        $this->goods = $goods;
        $this->type = $type;
    }


    public function index($goodsID)
    {
        $goods = $this->goods->find($goodsID);
//        $attributes = $this->type->find($goods->type_id)->attributes()->get();
        $goodsAttributes = $this->goods->getGoodsAttributesForSelect($goods);
        $goodsStocks = $goods->stocks()->get()->map(function ($item, $k) {
            $ret[$item->number] = explode(',', $item->goods_attr_id);
//            $ret = explode(',', $item->goods_attr_id);
//            $ret['number'] = $item->number;
            return $ret;
        });
//        dd($goodsAttributes);
//        dd();
        return view('admin/stock/index', compact('goods', 'goodsAttributes', 'goodsStocks'));
    }

    public function create(Request $request, $goodsID)
    {
        $this->validate($request, [
            'number' => 'required',
            'number[]' => 'numeric',
        ]);

        $this->goods->setGoodsStocks($goodsID, $request->except('_token'));
        return redirect('admin/goods');
    }
}
