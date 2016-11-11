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
            'email' => 'required|email',
        ];
    }

    public function messages()
    {
        return [
            'email.required' => '邮箱不能为空',
        ];
    }
}
