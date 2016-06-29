<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class CreateUserRequest extends Request
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
                'name' => 'required|unique:users|max:20',
                'email' => 'email|unique:users|max:40',
                'password' => 'required|confirmed'
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
            'name.required' => '用户名必须填写！',
            'name.unique'  => '用户名被占用',
            'name.max' => '用户名不应该超过20个字符！',

            'email.email' => '邮箱填写格式有误！',
            'email.unique'  => '邮箱被占用',
            'email.max' => '用户名不应该超过40个字符！',

            'password.required' => '密码必须填写！',
            'password.confirmed'=>'两次输入密码不一致！'
        ];
    }
}
