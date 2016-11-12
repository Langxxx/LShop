<?php

namespace App\Http\Requests\Admin\Goods;

use App\Http\Requests\Request;
use Illuminate\Support\Facades\Route;

class UpdateRequest extends Request
{

    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return $this->getMethod() == 'GET' ? [] : [
            'name' => 'required|max:50',
            'logo' => 'sometimes|image',
            'market_price' => 'numeric',
            'shop_price' => 'numeric',
            'sort_num' => 'numeric',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => '商品名不能为空',
            'name.max' => '商品名最大50个字符',
            'logo.image' => '上传文件必须为图片格式',
            'market_price.numeric' => '市面价必须是数值',
            'shop_price.numeric' => '市面价必须是数值',
            'sort_num.numeric' => '排序必须是数值',
        ];
    }
}
