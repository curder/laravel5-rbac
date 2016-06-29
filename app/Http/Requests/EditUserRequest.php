<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class EditUserRequest extends Request
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
            'password.required' => '密码必须填写！',
            'password.confirmed'=>'两次输入密码不一致！'
        ];
    }
}
