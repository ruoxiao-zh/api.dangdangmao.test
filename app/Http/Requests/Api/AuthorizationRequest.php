<?php

namespace App\Http\Requests\Api;

class AuthorizationRequest extends BaseRequest
{
    public function rules()
    {
        return [
            'phone'    => 'required|phone:CN,mobile',
            'password' => 'required|string',
        ];
    }

    public function messages()
    {
        return [
            'phone.required'    => '手机号不能为空',
            'phone.phone'       => '手机号格式不正确',
            'password.required' => '密码不能为空',
            'password.string'   => '密码必须为字符串类型',
        ];
    }
}
