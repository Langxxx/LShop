<?php

namespace App\Http\Controllers\Admin;

use App\Repositories\Eloquent\BrandRepository;
use App\Repositories\Eloquent\CategoryRepository;
use App\Repositories\Eloquent\GoodsRepository;
use Illuminate\Http\Request;

use App\Http\Requests\Admin\Goods\CreateRequest;
use App\Http\Requests\Admin\Goods\UpdateRequest;
use App\Http\Controllers\Controller;

class GoodsController extends BaseController
{
    protected $goods;
    protected $category;
    protected $brand;

    public function __construct(GoodsRepository $goods, CategoryRepository $category,
                                BrandRepository $brand)
    {
        parent::__construct();
        $this->goods = $goods;
        $this->category = $category;
        $this->brand = $brand;
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

        $categories = $this->category->getCategoriesForSelect();
        $brands = $this->brand->getBrandsForSelect();
        return view('admin/goods/create', compact('categories', 'brands'));
    }
}
