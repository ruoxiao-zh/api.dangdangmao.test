<?php

namespace App\Http\Requests\Api\Admin\User;

use App\Http\Requests\Api\BaseRequest;
use App\Models\Product;
use Illuminate\Validation\Rule;

class BannerRequest extends BaseRequest
{
    public function rules()
    {

        return [
            'product_id' => [
                'required',
                'integer',
                function ($attribute, $value, $fail) {
                    if ($value !== 0 && !Product::find($value)) {
                        return $fail('该商品不存在');
                    }
                },
            ],
            'type'       => [
                'required',
                'integer',
                Rule::in(['1, 2']),
            ],
            'position'   => [
                'required',
                'integer',
                Rule::in(['1, 2']),
            ],
            'banner'     => 'required|string|max:255',
            'sort'       => 'required|integer',
        ];
    }

    public function messages()
    {
        return [
            'product_id.required' => '商品 ID 不能为空',
            'product_id.integer'  => '商品 ID 必须是整数类型',
            'type.required'       => 'Banner 类型不能为空',
            'type.integer'        => 'Banner 类型必须是整数类型',
            'type.in'             => 'Banner 类型只能是 [1, 2] 中的一值',
            'position.required'   => 'Banner 显示位置不能为空',
            'position.integer'    => 'Banner 显示位置必须是整数类型',
            'position.in'         => 'Banner 显示位置只能是 [1, 2] 中的一值',
            'banner.required'     => 'Banner 不能为空',
            'banner.string'       => 'Banner 必须是字符串类型',
            'banner.max'          => 'Banner 最大值不能超过 255 个字符',
            'sort.required'       => '排序不能为空',
            'sort.integer'        => '排序必须是整数类型',
        ];
    }
}
