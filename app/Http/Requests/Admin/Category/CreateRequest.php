<?php

namespace App\Http\Requests\Admin\Category;

use App\Http\Requests\Request;

class CreateRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
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
            'name' => 'required|unique:categories',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => '分类名不能为空',
            'name.unique' => '分类已存在',
        ];
    }
}
