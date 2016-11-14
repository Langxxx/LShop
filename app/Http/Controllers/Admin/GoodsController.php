<?php

namespace App\Http\Controllers\Admin;

use App\Repositories\Eloquent\BrandRepository;
use App\Repositories\Eloquent\CategoryRepository;
use App\Repositories\Eloquent\GoodsRepository;
use App\Repositories\Eloquent\TypeRepository;
use App\Repositories\Presenter\TypeAttributesPresent;
use Illuminate\Http\Request;

use App\Http\Requests\Admin\Goods\CreateRequest;
use App\Http\Requests\Admin\Goods\UpdateRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class GoodsController extends BaseController
{
    protected $goods;
    protected $category;
    protected $brand;
    protected $type;
    protected $typeAttributesPresent;

    public function __construct(GoodsRepository $goods, CategoryRepository $category,
                                BrandRepository $brand, TypeRepository $type)
    {
        parent::__construct();
        $this->goods = $goods;
        $this->category = $category;
        $this->brand = $brand;
        $this->type = $type;
//        $this->typeAttributesPresent = $typeAttributesPresent;
    }

    public function index()
    {
        $allGoods = $this->goods->allForList()->paginate(15);
        return view('admin/goods/index', compact('allGoods'));
    }

    public function create(CreateRequest $request)
    {

        if ($request->getMethod() == 'POST') {
            $this->goods->create($request->except('_token'));
            return redirect('admin/goods');
        }

        $types = $this->type->getTypesForSelect();
        $categories = $this->category->getCategoriesForSelect();
        $brands = $this->brand->getBrandsForSelect();
        return view('admin/goods/create', compact('categories', 'brands', 'types'));
    }

    public function edit(UpdateRequest $request, $goodsID)
    {
        $goods = $this->goods->find($goodsID);
        if ($request->getMethod() == 'PUT') {
            $this->goods->update($goodsID, $request->except('_token'));
            return redirect('admin/goods');
        }
        $categories = $this->category->getCategoriesForSelect();
        $brands = $this->brand->getBrandsForSelect();
        $types = $this->type->getTypesForSelect();
        return view('admin/goods/edit', compact('categories', 'brands', 'goods', 'types'));
    }


    public function ajaxGetAttr($typeID)
    {
        $attributes = $this->type->find($typeID)->attributes()->get();
        if ($attributes->isEmpty()) {
            return response()->json(['status' => false, 'error' => '当前类型没有属性']);
        }else {
            return response()->json(['status' => 'ok', 'content' => $attributes->toArray()]);
        }
    }

    public function ajaxDeleteAttr($attrID)
    {
        //todo 这样删除会对库存造成影响吗?还有商品类型切换的时候删除的属性会影响吗?
        $attrID = $attrID + 0;
        $ret = DB::table('goods_attribute')->where('id', '=', $attrID)->delete();
        if ($ret) {
            return response()->json(['status' => true]);
        }else {
            return response()->json(['status' => false, 'error' => '删除失败']);
        }
    }

    public function ajaxDeleteImg($picID)
    {
        return $this->goods->deletePic($picID);
    }
}
