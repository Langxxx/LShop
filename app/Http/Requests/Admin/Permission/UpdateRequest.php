<?php

namespace App\Http\Requests\Admin\Permission;

use App\Http\Requests\Request;
use Illuminate\Support\Facades\Route;

class UpdateRequest extends Request
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
        $data = $this->request->all();
        return Route::currentRouteName() == 'admin.permission.edit' ? [] : [
            'name' => 'required|max:100',
            'display_name' => 'sometimes|max:100',
            'description' => 'sometimes|max:100',
//            'pid' => 'not_in:' . $data->id,
        ];
    }

    public function messages()
    {
        return [
            'name.required' => '权限名称必须',
            'name.max' => '权限名称最多100个字符',
            'display_name.max' => '权限显示名称最多100个字符',
            'description.max' => '权限说明最多100字符'
        ];
    }
}
