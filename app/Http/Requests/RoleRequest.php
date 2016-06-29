<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class RoleRequest extends Request
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
                'name' => 'required|unique:roles|max:20',
                'display_name' => 'required|max:20',
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
            'name.required' => '角色英文名必须填写！',
            'name.unique'  => '角色英文名被占用',
            'name.max' => '角色英文名不应该超过20个字符！',

            'display_name.required' => '角色中文名必须填写！',
            'display_name.max' => '角色中文名不应该超过20个字符！'

        ];
    }
}
