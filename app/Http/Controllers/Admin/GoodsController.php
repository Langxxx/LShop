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
        $categories = $this->category->getCategoriesForSelect();
        $brands = $this->brand->getBrandsForSelect();
        return view('admin/goods/edit', compact('categories', 'brands', 'goods'));
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
}
