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
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;

class GoodsRepository extends  Repository
{
    public function model()
    {
        return Goods::class;
    }

    public function create(array $attributes)
    {
//        dd($attributes);
        if (isset($attributes['logo'])) {
            $ret = uploadOne($attributes['logo'], 'goods/', 90, [[200, 200]]);
            if ($ret['status']) {
                $attributes['logo'] = $ret['images'][0];
                $attributes['sm_logo'] = $ret['images'][1];
            }
        }

        $attrValues = $attrValues = $attributes['attr_value'];

        $attrPrice = [];
        if (isset($attributes['attr_price'])) {
            $attrPrice = $attributes['attr_price'];
        }

        $pics = $attributes['pics'];

        $goods = parent::create($attributes);
        //处理商品属性
        foreach ($attrValues as $attrID => $attrs) {
            if (!isset($attrs)) {
                continue;
            }

            foreach ($attrs as $k => $attr) {
//                if (empty($attr)) {
//                    continue;
//                }

                $price = isset($attrPrice[$attrID][$k]) ? $attrPrice[$attrID][$k] : 0;

                $goods->attributes()->attach($attrID, [
                    'attr_value' => $attr,
                    'attr_price' => $price,
                ]);
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

    public function update($id, array $attributes)
    {
//        dd($attributes);
        //处理图片
        if (isset($attributes['logo'])) {
            $ret = uploadOne($attributes['logo'], 'goods/', 90, [[200, 200]]);
            if ($ret['status']) {

                //删除之前的图片
                if ($attributes['old_logo'] != "") {
                    deleteImages([
                        $attributes['old_logo'],
                        $attributes['old_sm_logo'],
                    ]);
                }

                $attributes['logo'] = $ret['images'][0];
                $attributes['sm_logo'] = $ret['images'][1];
            }
        }

        $attrValues = [];
        if (isset($attributes['attr_value'])) {
            $attrValues = $attributes['attr_value'];
        }
        $oldAttrValues = [];
        if (isset($attributes['old_attr_value'])) {
            $oldAttrValues = $attributes['old_attr_value'];
        }

        $attrPrice = [];
        if (isset($attributes['attr_price'])) {
            $attrPrice = $attributes['attr_price'];
        }
        $oldAttrPrice = [];
        if (isset($attributes['old_attr_price'])) {
            $oldAttrPrice = $attributes['old_attr_price'];
        }

        $pics = $attributes['pics'];

        $goods = $this->find($id);
        //处理商品属性

        //处理之前的属性
        if ($attributes['type_id'] != $attributes['old_type_id']) {
            //换了类型,删除所有属性
            $goods->attributes()->detach();
        }else {

            foreach ($oldAttrValues as $attrID => $attrs) {
                if (!isset($attrs)) {
                    continue;
                }
                foreach ($attrs as $k => $attr) {

                    $price = isset($oldAttrPrice[$attrID][$k]) ? $oldAttrPrice[$attrID][$k] : 0;

                    $goods->attributes()
                        ->where('goods_attribute.id', '=', $k)
                        ->update([
                            'attr_value' => $attr,
                            'attr_price' => $price,
                        ]);
                }
            }
        }

        //处理新添加的属性
        foreach ($attrValues as $attrID => $attrs) {
            if (!isset($attrs)) {
                continue;
            }
            foreach ($attrs as $k => $attr) {

                $price = isset($attrPrice[$attrID][$k]) ? $attrPrice[$attrID][$k] : 0;

                $goods->attributes()->attach($attrID, [
                    'attr_value' => $attr,
                    'attr_price' => $price,
                ]);
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


        return $goods->update($attributes);
    }

    public function allForList()
    {
        $allGoods = $this->with('category')->with('brand');
        return $allGoods;
    }

    public function deletePic($picID)
    {

        $picID = $picID + 0;
        $tmp = DB::table('goods_pics')->where('id', '=', $picID);
        $pic = $tmp->first();

        deleteImages([$pic->pic, $pic->sm_pic]);

        if ($tmp->delete()) {
            return response()->json(['status' => true]);
        }else {
            return response()->json(['status' => false, 'error' => '删除失败']);
        }
    }

}