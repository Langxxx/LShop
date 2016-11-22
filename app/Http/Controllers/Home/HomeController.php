<?php

namespace App\Http\Controllers\Home;

use App\Repositories\Eloquent\CategoryRepository;
use App\Repositories\Eloquent\GoodsRepository;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    protected $category;
    protected $goods;

    public function __construct(CategoryRepository $category, GoodsRepository $goods)
    {
        $this->category = $category;
        $this->goods = $goods;
    }

    public function index()
    {
        $categories = $this->category->tree();
        $hotGoods = $this->goods->getHotGoods();
        $newGoods = $this->goods->getNewGoods();
        return view('home/index', compact('categories', 'hotGoods', 'newGoods'));
    }

    public function goods($goodsID)
    {
        $goods = $this->goods
            ->find($goodsID);
        $goodsPics = $goods->pics()->get();
        $attributes = $this->goods->getGoodsAttributesForSelect($goods);
        $staticAttributes = $this->goods->getGoodsStaticAttributes($goods);
        return view('home/introduction', compact('goods', 'attributes', 'goodsPics', 'staticAttributes'));
    }

    public function category()
    {
        return view('home.category');
    }
}
