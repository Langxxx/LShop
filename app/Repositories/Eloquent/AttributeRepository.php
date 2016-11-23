<?php
/**
 * Created by PhpStorm.
 * User: wl
 * Date: 16/11/7
 * Time: 19:14
 */
namespace App\Repositories\Eloquent;

use App\Models\Attribute;
use App\Repositories\Eloquent\Repository;
use Illuminate\Support\Facades\DB;

class AttributeRepository extends  Repository
{
    public function model()
    {
        return Attribute::class;
    }

    public function getSearchInfoByAttrIDs($searchAttrIDs, $needSelect = true)
    {
        $searchInfo = $this->findWhereIn('id', explode(',', $searchAttrIDs))
            ->with('type')
            ->with('type.attributes')
            ->groupBy('type_id')
            ->get();
//            ->each(function($item, $key) {
//
//            });

//        dd($searchInfo);
        foreach ($searchInfo as $index => $search_type) {
            $type = $search_type->relationsToArray();

            if ($needSelect) {
                $selectAttr = [];
                foreach ($type['type']['attributes'] as $attribute) {
                    $selectAttr[$attribute['id']] = $attribute['name'];
                }
                $type['type']['attributes']['selectAttr'] = $selectAttr;
            }else {
                //todo 商品可选但可选值为空
//                foreach ($type['type']['attributes'] as $attribute) {
//                    if(empty($attribute['option_value']) && $attribute['type_id'] == 1) {
//                        $attribute['option_value'] = DB::table('goods_attribute')
//                            ->select(DB::raw('GROUP_CONCAT(attribute_id) attribute_id'))
//                            ->where('attribute_id', $attribute['id'])
//                            ->first()->attribute_id;
//                    }
//                }
            }
            $searchInfo[$index] = $type;
        }

        return $searchInfo;
    }
}