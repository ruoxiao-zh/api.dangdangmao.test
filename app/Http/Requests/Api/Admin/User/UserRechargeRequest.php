<?php

namespace App\Http\Requests\Api\Admin\User;

use App\Http\Requests\Api\BaseRequest;

class UserRechargeRequest extends BaseRequest
{
    public function rules()
    {
        return [
            'id'    => 'required|integer',
            'money' => 'required|min:1',
        ];
    }

    public function messages()
    {
        return [
            'id.required'    => '用户 ID 不能为空',
            'id.integer'     => '用户 ID 必须是整数',
            'money.required' => '充值金额不能为空',
            'money.min'      => '充值金额最小不能低于 1',
        ];
    }
}
