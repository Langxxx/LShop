<?php

namespace App\Http\Requests\Admin\Admin;

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
            'email' => 'required|email|unique:admins',
            'password' => 'required|confirmed',
        ];
    }

    public function messages()
    {
        return [
            'email.required' => '邮箱不能为空',
            'email.email' => '邮箱格式不正确',
            'email.unique' => '邮箱已被注册',
            'password.required' => '密码不能为空',
            'password.confirmed' => '两次密码不一致',
        ];
    }
}
