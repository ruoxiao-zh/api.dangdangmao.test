<?php

namespace App\Http\Requests\Api\Admin\User;

use App\Http\Requests\Api\BaseRequest;
use Illuminate\Validation\Rule;

class UserChangePasswordRequest extends BaseRequest
{
    public function rules()
    {
        return [
            'type'     => [
                'required',
                Rule::in(['login', 'trade']),
            ],
            'password' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'required.required' => '密码类型不能为空',
            'required.in'       => "密码类型只能是 ['login', 'trade'] 数组中的值",
            'password.required' => '密码不能为空',
        ];
    }
}
