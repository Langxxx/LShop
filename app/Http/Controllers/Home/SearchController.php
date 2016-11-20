<?php

namespace App\Http\Controllers\Home;

use App\Models\Attribute;
use App\Models\Goods;
use App\Repositories\Eloquent\AttributeRepository;
use App\Repositories\Eloquent\CategoryRepository;
use App\Repositories\Eloquent\GoodsRepository;
use App\Repositories\Eloquent\TypeRepository;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class SearchController extends Controller
{
    protected $category;
    protected $type;
    protected $attribute;

    public function __construct(CategoryRepository $category, TypeRepository $type, AttributeRepository $attribute)
    {
        $this->category = $category;
        $this->type = $type;
        $this->attribute = $attribute;
    }

    public function search($categoryID)
    {
        $category= $this->category
            ->find($categoryID);
        $category->search_types = $this->attribute
            ->getSearchInfoByAttrIDs($category->search_attr_id, false);

        //取出商品数据
        $allGoods = $category->goods()->get();

//        dd($category);
        return view('home.search', compact('category', 'allGoods'));
    }
}
