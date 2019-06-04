<?php

namespace App\Http\Requests\Api\Admin\User;

use App\Http\Requests\Api\BaseRequest;

class UserTypeRequest extends BaseRequest
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
                        'Name'            => 'required|string',
                        'buy_price'       => 'required|integer',
                        'annualfee_price' => 'required|integer',
                        'discount'        => 'required|numeric',
                        'active_time'     => 'required|integer',
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
            'Name.required'            => '级别名称不能为空',
            'Name.string'              => '级别名称必须是字符串数据类型',
            'buy_price.required'       => '推荐名额价格不能为空',
            'buy_price.integer'        => '推荐名额价格必须是整数类型',
            'annualfee_price.required' => '年费金额不能为空',
            'annualfee_price.integer'  => '年费金额必须是整数类型',
            'discount.required'        => '会员折扣不能为空',
            'discount.integer'         => '会员折扣必须是数字类型',
            'active_time.required'     => '有效时间不能为空',
            'active_time.string'       => '有效时间必须是整数类型',
        ];
    }
}
