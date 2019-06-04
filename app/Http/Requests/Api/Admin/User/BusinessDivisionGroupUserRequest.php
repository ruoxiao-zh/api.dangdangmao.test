<?php

namespace App\Http\Requests\Api\Admin\User;

use App\Http\Requests\Api\BaseRequest;
use Illuminate\Validation\Rule;

class BusinessDivisionGroupUserRequest extends BaseRequest
{
    public function rules()
    {
        switch ($this->method()) {
            case 'POST':
                {
                    return [

                    ];
                }
            case 'PUT':
            case 'PATCH':
                {
                    return [
                        'account'  => [
                            'required',
                            'string',
                            'max:50',
                            Rule::unique('business_division')->ignore(request()->businessDivision->id),
                        ],
                        'password' => 'sometimes',
                        'status'   => [
                            'required',
                            'integer',
                            Rule::in([1, 2]),
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
            'account.required' => '事业部账号不能为空',
            'account.string'   => '事业部账号必须是字符串数据类型',
            'account.max'      => '事业部账号最大长度不能超过 50 个字符',
            'account.unique'   => '事业部账号已经存在',
            'status.required'  => '事业部账号状态不能为空',
            'status.integer'   => '事业部账号状态必须是整数类型',
            'status.in'        => '事业部账号状态只能是 [1, 2] 中的值',
        ];
    }
}
