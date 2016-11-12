<?php
/**
 * Created by PhpStorm.
 * User: wl
 * Date: 16/11/7
 * Time: 19:14
 */
namespace App\Repositories\Eloquent;

use App\Models\Goods;
use App\Models\GoodsPics;
use App\Repositories\Eloquent\Repository;
use Illuminate\Support\Facades\Input;

class GoodsRepository extends  Repository
{
    public function model()
    {
        return Goods::class;
    }

    public function create(array $attributes)
    {
//        dd($attributes['pics'][0]);
        if (isset($attributes['logo'])) {
            $ret = uploadOne($attributes['logo'], 'goods/', 90, [[200, 200]]);
            if ($ret['status']) {
                $attributes['logo'] = $ret['images'][0];
                $attributes['sm_logo'] = $ret['images'][1];
            }
        }

        $attrValues = $attributes['attr_value'];
        unset($attributes['attr_value']);
        $attrPrice = $attributes['attr_price'];
        unset($attributes['attr_price']);
        $pics = $attrPrice = $attributes['pics'];
        unset($attributes['pics']);

        $goods = parent::create($attributes);
        //处理商品属性
        if (!empty($attrValues)) {
            foreach ($attrValues as $attrID => $attrs) {
                if (empty($attrs)) {
                    continue;
                }
                foreach ($attrs as $k => $attr) {
                    if (empty($attr)) {
                        continue;
                    }

                    $price = isset($attrPrice[$attrID][$k]) ? $attrPrice[$attrID][$k] : 0;

                    $goods->attributes()->attach($attrID, [
                        'attr_value' => $attr,
                        'attr_price' => $price,
                    ]);
                }
            }
        }

        //处理相册
        if (!empty($pics)) {
            foreach ($pics as $pic) {
                if ($pic == null) {
                    continue;
                }
                //上传图片
                $ret = uploadOne($pic, 'goods/', 90, [[200, 200]]);
                if ($ret['status']) {
                    $goods->pics()->create([
                        'pic' => $ret['images'][0],
                        'sm_pic' => $ret['images'][1],
                    ]);
                }
            }
        }

        return  $goods;
    }

    public function allForList()
    {
        $allGoods = $this->with('category')->with('brand');
        return $allGoods;
    }

}