<?php
/**
 * Created by PhpStorm.
 * User: wl
 * Date: 16/11/13
 * Time: 10:33
 */
namespace App\Services;

use App\Repositories\Eloquent\TypeRepository;

class GoodsAttributeViewService
{
    protected $type;

    public function __construct(TypeRepository $type)
    {
        $this->type = $type;
    }

    public function getGoodsAttributeView($goodsAttributes, $typeID)
    {
        //找到所有的属性
        $allAttribute = $this->type->find($typeID)->attributes()->get();
//
        $diffs = $allAttribute->diff($goodsAttributes);
        if (count($diffs) > 0) {
            foreach ($diffs as $item) {
                $item->isNew = true;
                $goodsAttributes[] = $item;
            }
        }
        $html = '';
        $attrIDs = [];
        $goodsAttributes = $goodsAttributes->sortBy('id');
        foreach ($goodsAttributes as $attribute) {
            if ($attribute->type == 1) {

                if (in_array($attribute->id, $attrIDs)) {
                    $flag = '[-]';
                }else {
                    $attrIDs[] = $attribute->id;
                    $flag = '[+]';
                }

                $html .= "<div class='form-group'>";
                if (isset($attribute->isNew)) {
                    $html .= "<label class='col-sm-2 control-label'><a onclick='addNew(this)'" . "href='javascript:void(0);'>$flag</a>" . $attribute->name  . ":</label>";
                }else {
                    $html .= "<label class='col-sm-2 control-label'>" . "<a attrID='" . $attribute->pivot->id . "' onclick='addNew(this)'" .
                        "href='javascript:void(0);'>$flag</a>" . $attribute->name  . ":</label>";
                }
            }else {
                $html .= "<div class='form-group'>";
                $html .= "<label class='col-sm-2 control-label'>"  . $attribute->name  . ":</label>";
            }

            if ($attribute->option_value == "") {
                $html .= '<div class="col-sm-5">';
                if (isset($attribute->isNew)) {
                    $html .= "<input name='attr_value[" . $attribute->id . "][]' class='form-control'>";

                }else {
                    $html .= "<input name='old_attr_value[" . $attribute->id . "][" . $attribute->pivot->id . "]' class='form-control' value='" . $attribute->pivot->attr_value . "'>";
                }
                $html .= '</div>';
            }else {
                $html .= '<div class="col-sm-5">';
                //把可选值转化成下拉框
                $attr = explode(',', $attribute->option_value);
                if (isset($attribute->isNew)) {
                    $html .= "<select name='attr_value[" . $attribute->id . "][]' class='form-control'>";
                } else {
                    $html .= "<select name='old_attr_value[" . $attribute->id . "][" . $attribute->pivot->id . "]' class='form-control'>";
                }

                $html .= "<option value=''>请选择</option>";

                for ($i=0; $i < count($attr); $i++){
//                    $html .= "<option value='$attr[$i]'>$attr[$i]</option>";
                    if (isset($attribute->isNew)) {
                        $html .= "<option value='$attr[$i]'>$attr[$i]</option>";
                    } else {
                        if ($attr[$i] == $attribute->pivot->attr_value) {
                            $html .= "<option value='$attr[$i]' selected='selected'>$attr[$i]</option>";
                        }else {
                            $html .= "<option value='$attr[$i]'>$attr[$i]</option>";
                        }
                    }

                }
                $html .= "</select>";
                $html .= '</div>';
            }

            if ($attribute->type == 1) {
                $html .= '<div class="col-sm-5">';
                if (isset($attribute->isNew)) {
                    $html .= "<input name='attr_price[" . $attribute->id . "][]' class='form-control' " . "placeholder='价格/单位/人民币'>";
                }else {
                    $html .= "<input name='old_attr_price[" . $attribute->id . "][" . $attribute->pivot->id . "]' value='" . $attribute->pivot->attr_price . "' class='form-control' " . "placeholder='价格/单位/人民币'>";
                }
                $html .= '</div>';
            }
            $html .= '</div>';
        }
        return $html;
    }
}