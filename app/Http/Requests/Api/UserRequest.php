<?php

namespace App\Http\Requests\Api;

use Illuminate\Validation\Rule;

class UserRequest extends BaseRequest
{
    public function rules()
    {
        switch ($this->method()) {
            case 'POST':
                {
                    return [];
                }
            case 'PUT':
            case 'PATCH':
                {
                    return [
                        'AvatarUrl' => 'required|string',
                        'Nickname'  => [
                            'required',
                            'string',
                            'max:50',
                            Rule::unique('member')->ignore($this->user()->ID),
                        ],
                        'introduce' => 'required|string',
                        'Sex'       => [
                            'required',
                            Rule::in([0, 1]),
                        ],
                    ];
                }
            case 'GET':
            case 'DELETE':
            default:
                {
                    return [];
                }
        }
    }

    public function messages()
    {
        return [
            'AvatarUrl.required' => '用户头像不能为空',
            'AvatarUrl.string'   => '用户头像必须是字符串数据类型',
            'Nickname.required'  => '用户昵称不能为空',
            'Nickname.string'    => '用户昵称必须是字符串数据类型',
            'Nickname.max'       => '用户昵称最大值不能超过 50 个字符',
            'Nickname.unique'    => '用户昵称已存在, 请确保唯一',
            'introduce.required' => '个人简介不能为空',
            'introduce.string'   => '个人简介必须是字符串数据类型',
            'Sex.required'       => '性别不能为空',
            'Sex.in'             => '性别只能是 [0, 1] 中的一个值',
        ];
    }
}
