<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class PermissionRequest extends Request
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
        $rules = [];
        if($this->isMethod('post')){
            $rules = [
                'name' => 'required|unique:permissions',
                'display_name' => 'required',
            ];
        }
        return $rules;
    }

    /**
     * @return array
     */
    public function messages()
    {
        return [
            'name.required' => '权限英文名必须填写！',
            'name.unique'  => '权限英文名被占用',

            'display_name.required' => '权限中文名必须填写！',
        ];
    }
}
