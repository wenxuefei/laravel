<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
        $rules = [
            'password' => 'required|regex:/\w{6,20}/|same:confirm',
        ];
        $username = 'required|regex:/\w{5,20}/|unique:admins,username';
        if (request('id', '')) {
            $username .= ',' . $this->id;
        }

        $rules['username'] = $username;


        if (request('phone', '')) {
            $phone = 'regex:/^1[3456789]\d{9}$/unique:admins,phone';

            if(request('id', '')){
                $phone .= ',' . $this->id;
            }

            $rules['mobile'] = $phone;
        }


        return $rules;
    }

    public function messages()
    {
        return [
            //
            'username.required' => '用户名不能为空',
            'username.unique' => '用户名不能重复',
            'username.regex' => '用户名规则不正确，请填写5-20位字母数字下划线',
            'password.required' => '密码不能为空',
            'password.same' => '两次密码不一致',
            'mobile.unique' => '手机号不能重复',
        ];
    }
}
