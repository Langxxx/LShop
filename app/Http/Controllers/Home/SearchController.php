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
use Illuminate\Support\Facades\Input;

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

    public function search()
    {
        //todo 缓存

        $categoryID = Input::get('category_id');
        $category= $this->category
            ->find($categoryID);
        $category->search_types = $this->attribute
            ->getSearchInfoByAttrIDs($category->search_attr_id, false);



        //搜索属性
        $searchAttrs = Input::get('search_attr');
        $goodsIDs = null;
        if ($searchAttrs) {
            $searchAttrs = explode('_', $searchAttrs);

            foreach ($searchAttrs as $searchAttr) {

                if ($searchAttr == '0') {
                    continue;
                }

                $searchInfo = explode('-', $searchAttr);

                $tempSearch = DB::table('goods_attribute')->select(DB::raw('GROUP_CONCAT(goods_id) goods_id'))
                    ->where('attribute_id', $searchInfo[0])
                    ->where('attr_value', $searchInfo[1])
                    ->first();

                $tempSearch = $tempSearch->goods_id;
                if ($goodsIDs == null) {
                    $goodsIDs = explode(',', $tempSearch);
                }else {
                    $tempSearch = explode(',', $tempSearch);
                    $goodsIDs = array_intersect($goodsIDs, $tempSearch);
                    if (empty($goodsIDs)) {
                        $goodsIDs[] = 0;
                        break;
                    }
                }
            }
        }

        //取出商品数据
        $allGoods = $category->goods()
            ->when($goodsIDs, function ($query) use ($goodsIDs) {
                return $query->whereIn('id', $goodsIDs);
            })
            ->get();


        //取出价格区间
        $priceArray = $this->getPriceSection($allGoods);

        //判断是否搜索价格
        if ($price = Input::get('price')) {
            $price =  explode('-', $price);
            $min = $price[0];
            $max = $price[1];
            $allGoods = $allGoods->filter(function ($item) use ($min, $max) {
                return $item['shop_price'] >= $min && $item['shop_price'] < $max;
            });
        }



        return view('home.search', compact('category', 'allGoods', 'priceArray'));
    }

    protected function getPriceSection($allGoods, $priceSection = 7)
    {
        $priceArray = [];
        if(!$allGoods->isEmpty()) {

            $minPrice = $allGoods->min('shop_price');
            $maxPrice = $allGoods->max('shop_price');
            $priceRate = ceil(($maxPrice - $minPrice) / $priceSection);
            $firstPrice = $minPrice;
            for ($i = 0; $i < $priceSection; $i++) {
                $start = floor($firstPrice * 0.1) * 10;

                if ($i < ($priceSection - 1)) {
                    $end = floor(($firstPrice + $priceRate) * 0.1) * 10 - 1;
                    $firstPrice += $priceRate;
                }else {
                    $end = ceil(($firstPrice + $priceRate) * 0.1) * 10;
                }

                if (!$allGoods->whereInLoose('shop_price', [$start, $end])->isEmpty()) {
                    $priceArray[$i] = $start . '-' . $end;
                }
                $ret = $allGoods->search(function($item, $key) use($start ,$end) {
                    return $item['shop_price'] > $start && $item['shop_price'] < $end;
                });
                if ($ret !== false) {
                    $priceArray[$i] = $start . '-' . $end;
                }
            }
        }

        return $priceArray;
    }

}
