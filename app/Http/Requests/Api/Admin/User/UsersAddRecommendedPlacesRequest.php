<?php

namespace App\Http\Requests\Api\Admin\User;

use App\Http\Requests\Api\BaseRequest;
use Illuminate\Validation\Rule;

class UsersAddRecommendedPlacesRequest extends BaseRequest
{

    public function rules()
    {
        return [
            'id'           => 'required|integer',
            'user_type_id' => [
                'required',
                Rule::in([1, 2, 3, 4]),
            ],
            'buy_num'      => 'required|integer|min:1',
        ];
    }

    public function messages()
    {
        return [
            'id.required'           => '用户 ID 不能为空',
            'id.integer'            => '用户 ID 必须是整数',
            'user_type_id.required' => '用户类型 ID 不能为空',
            'user_type_id.in'       => "用户类型 ID 必须是 '[1, 2, 3, 4]' 中的一个值",
            'buy_num.required'      => '购买数量不能为空',
            'buy_num.integer'       => '购买数量必须是整数类型',
            'buy_num.min'           => '购买数量最小值不能低于 1',
        ];
    }
}
