<?php
/**
 * Created by PhpStorm.
 * User: wl
 * Date: 16/11/13
 * Time: 10:33
 */
namespace App\Services;


use Illuminate\Support\Facades\Input;

class SearchService
{
    public function getSearchPanel($priceInfo, $categoryInfo)
    {
        $html = '';
            //todo 尝试使用集合

        $attrData = explode(',', $categoryInfo->search_attr_id);
        $attrDataCount = count($attrData);
        $oldSearchAttr = Input::get('search_attr');
        if ($oldSearchAttr) {
            $attrSearchArray = explode('_', $oldSearchAttr);
        }else {
            $attrSearchArray = array_fill(0, $attrDataCount, 0);
        }

        $html .= $this->pricePanel($priceInfo, $categoryInfo, $attrSearchArray);

        $html .= $this->attrPanel($categoryInfo, $attrData, $attrSearchArray);


        return $html;
    }


    protected function pricePanel($priceInfo, $categoryInfo, $attrSearchArray)
    {
        $html = '';
        $html .= '<li class="select-list">';
        $html .= '<dl id="select_1" class="attr_select">';
        $html .= '<dt class="am-badge am-round">价格</dt>';
        $html .= '<div class="dd-conent">';

        $parameter = ['category_id' => $categoryInfo->id];
        $price = Input::get('price');
        $parameter['search_attr'] = implode('_', $attrSearchArray);
        $url = route('search', $parameter);

        if ($price == null) {
            $html .= '<dd class="select-all selected" ><a href="' . $url . '">全部</a></dd>';
        }else {
            $html .= '<dd class="select-all" ><a href="' . $url . '">全部</a></dd>';
        }

        foreach ($priceInfo as $currentPrice) {

            $parameter = ['category_id' => $categoryInfo->id];
            $parameter['price'] = $currentPrice;
            $parameter['search_attr'] = implode('_', $attrSearchArray);
            $url = route('search', $parameter);

            $class = $price == $currentPrice ? 'class=selected' : "";
            $html .= '<dd ' . $class . '>';
            $html .= '<a href="'.$url.'">' . $currentPrice . '</a>';
            $html .= '</dd>';
        }
        $html .= '</div>';
        $html .= '</dl>';
        $html .= '</li>';

        return $html;
    }

    protected function attrPanel($categoryInfo, $attrData, $attrSearchArray)
    {
        $html = '';
        $indexAttr = 0;
        foreach ($categoryInfo->search_types as $searchType) {
            foreach ($searchType['type']['attributes'] as $attr) {
                if (in_array($attr['id'], $attrData) !== false) {
                    $html .= '<li class="select-list">';
                    $html .= '<dl id="' . 'select' . ($indexAttr+2) . '" class="attr_select">';
                    $html .= '<dt class="am-badge am-round">' . $attr['name'] . '</dt>';
                    $html .= '<div class="dd-conent">';

                    $parameter = ['category_id' => $categoryInfo->id];
//                    if ($price = Input::get('price')) {
//                        $parameter['price'] = $price;
//                    }
                    $tempAttrSearchArray = $attrSearchArray;
                    $tempAttrSearchArray[$indexAttr] = 0;
                    $parameter['search_attr'] = implode('_', $tempAttrSearchArray);
                    $url = route('search', $parameter);

                    if ($attrSearchArray[$indexAttr] == '0') {
                        $html .= '<dd class="select-all selected"><a href="'.$url.'">全部</a></dd>';
                    }else {
                        $html .= '<dd class="select-all"><a href="'.$url.'">全部</a></dd>';
                    }

                    foreach (explode(',', $attr['option_value']) as $attrValue) {

                        $parameter = ['category_id' => $categoryInfo->id];
//                        if ($price = Input::get('price')) {
//                            $parameter['price'] = $price;
//                        }
                        $tempAttrSearchArray = $attrSearchArray;
                        $tempAttrSearchArray[$indexAttr] = $attr['id'] . '-' . $attrValue;
                        $parameter['search_attr'] = implode('_', $tempAttrSearchArray);
                        $url = route('search', $parameter);

                        if ($attrSearchArray[$indexAttr] == $tempAttrSearchArray[$indexAttr]) {
                            $html .= '<dd class="selected"><a href="' . $url . '">' . $attrValue . '</a></dd>';
                        }else {
                            $html .= '<dd><a href="' . $url . '">' . $attrValue . '</a></dd>';
                        }

                    }
                    $html .= '</div>';
                    $html .= '</dl>';
                    $html .= '</li>';
                    $indexAttr++;
                }
            }
        }
        return $html;
    }
}