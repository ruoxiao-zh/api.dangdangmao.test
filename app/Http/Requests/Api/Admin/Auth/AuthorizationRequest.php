<?php

namespace App\Http\Requests\Api\Admin\Auth;

use App\Http\Requests\Api\BaseRequest;

class AuthorizationRequest extends BaseRequest
{
    public function rules()
    {
        return [
            'account'      => 'required|string',
            'password'     => 'required|string',
            'captcha_key'  => 'required|string',
            'captcha_code' => 'required|string',
        ];
    }

    public function messages()
    {
        return [
            'account.required'      => '登录账号不能为空',
            'account.string'        => '登录账号必须为字符串数据类型',
            'password.required'     => '密码不能为空',
            'password.string'       => '密码必须为字符串数据类型',
            'captcha_key.required'  => '验证码 key 不能为空',
            'captcha_key.string'    => '验证码 key 必须为字符串数据类型',
            'captcha_code.required' => '验证码不能为空',
            'captcha_code.string'   => '验证码必须为字符串数据类型',
        ];
    }
}
