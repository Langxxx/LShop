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
    public function getGoodsAttributeView($goodsAttributes)
    {
        $html = '';
        $attrIDs = [];
        foreach ($goodsAttributes as $attribute) {

            if ($attribute->type == 1) {
                if (in_array($attribute->id, $attrIDs)) {
                    $flag = '[-]';
                }else {
                    $attrIDs[] = $attribute->id;
                    $flag = '[+]';
                }
                $html .= "<div class='form-group'>";
                $html .= "<label class='col-sm-2 control-label'>" . "<a attrID='" . $attribute->pivot->id . "' onclick='addNew(this)'" .
                   "href='javascript:void(0);'>$flag</a>" . $attribute->name  . ":</label>";
            }else {
                $html .= "<div class='form-group'>";
                $html .= "<label class='col-sm-2 control-label'>"  . $attribute->name  . ":</label>";
            }

            if ($attribute->option_value == "") {
                $html .= '<div class="col-sm-5">';
                $html .= "<input name='old_attr_value[" . $attribute->id . "][" . $attribute->pivot->id . "]' class='form-control' value='" . $attribute->pivot->attr_value . "'>";
                $html .= '</div>';
            }else {
                $html .= '<div class="col-sm-5">';
                //把可选值转化成下拉框
                $attr = explode(',', $attribute->option_value);
                $html .= "<select name='old_attr_value[" . $attribute->id . "][" . $attribute->pivot->id . "]' class='form-control'>";
                $html .= "<option value=''>请选择</option>";

                for ($i=0; $i < count($attr); $i++){
//                    $html .= "<option value='$attr[$i]'>$attr[$i]</option>";
                    if ($attr[$i] == $attribute->pivot->attr_value) {
                        $html .= "<option value='$attr[$i]' selected='selected'>$attr[$i]</option>";
                    }else {
                        $html .= "<option value='$attr[$i]'>$attr[$i]</option>";
                    }
                }
                $html .= "</select>";
                $html .= '</div>';
            }

            if ($attribute->type == 1) {
                $html .= '<div class="col-sm-5">';
                $html .= "<input name='old_attr_price[" . $attribute->id . "][" . $attribute->pivot->id . "]' value='" . $attribute->pivot->attr_price . "' class='form-control' " . "placeholder='价格/单位/人民币'>";
                $html .= '</div>';
            }

            $html .= '</div>';
        }
        return $html;
    }
}