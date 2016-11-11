<?php

namespace App\Http\Requests\Admin\Brand;

use App\Http\Requests\Request;
use Illuminate\Support\Facades\Route;

class CreateRequest extends Request
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
    public function rules()
    {
        return $this->getMethod() == 'GET' ? [] : [
            'name' => 'required',
//            'url' => 'sometimes|url',
            'logo' => 'sometimes|image',
        ];
    }

    public function messages()
    {
        return [
            'required' => '名称不能为空',
            'image.email' => '上传文件必须为图片格式',
        ];
    }
}
