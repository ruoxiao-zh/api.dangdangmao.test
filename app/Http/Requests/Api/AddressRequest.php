<?php

namespace App\Http\Requests\Api;

use Illuminate\Validation\Rule;

class AddressRequest extends BaseRequest
{
    public function rules()
    {
        return [
            'ReceiveName' => 'required|string',
            'Mobile'      => 'required|phone:CN,mobile',
            'PostCode'    => 'required|string',
            'County'      => 'required|string',
            'Province'    => 'required|string',
            'City'        => 'required|string',
            'Address'     => 'required|string',
            'IsDefault'   => [
                'required',
                Rule::in([0, 1]),
            ],
        ];
    }

    public function messages()
    {
        return [
            'ReceiveName.required' => '收货人姓名不能为空',
            'ReceiveName.string'   => '收货人姓名必须是字符串数据类型',
            'Mobile.required'      => '收货人电话不能为空',
            'Mobile.phone'         => '收货人电话格式不正确',
            'PostCode.required'    => '邮政编码不能为空',
            'PostCode.string'      => '邮政编码必须是字符串数据类型',
            'County.required'      => '县编码不能为空',
            'County.string'        => '县编码必须是字符串数据类型',
            'Province.required'    => '省编码不能为空',
            'Province.string'      => '省编码必须是字符串数据类型',
            'City.required'        => '市编码不能为空',
            'City.string'          => '市编码必须是字符串数据类型',
            'Address.required'     => '详细地址不能为空',
            'Address.string'       => '详细地址必须是字符串数据类型',
            'IsDefault.required'   => '是否为默认收货地址不能为空',
            'IsDefault.in'         => '是否为默认收货地址必须是 [0, 1] 中的一个值',
        ];
    }
}
