<?php

namespace App\Http\Requests\Admin\Type;

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
            'name' => 'required|unique:types',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => '类型不能为空',
            'name.unique' => '类型已存在',
        ];
    }
}
