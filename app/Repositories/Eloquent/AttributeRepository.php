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
            ->with(['type.attributes' => function($query) {
                $query->where('attributes.option_value', '!=', '');
            }])
            ->groupBy('type_id')
            ->get();

        foreach ($searchInfo as $index => $search_type) {
            $type = $search_type->relationsToArray();

            if ($needSelect) {
                $selectAttr = [];
                foreach ($type['type']['attributes'] as $attribute) {
                    $selectAttr[$attribute['id']] = $attribute['name'];
                }
                $type['type']['attributes']['selectAttr'] = $selectAttr;
            }
            $searchInfo[$index] = $type;
        }

        return $searchInfo;
    }
}