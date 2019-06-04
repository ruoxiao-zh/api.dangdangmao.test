<?php

namespace App\Http\Requests\Api\Admin\User;

use App\Http\Requests\Api\BaseRequest;
use App\Models\UserStoreCategory;
use Illuminate\Validation\Rule;

class FourLevelPlacesUserCategoryRequest extends BaseRequest
{
    public function rules()
    {
        switch ($this->method()) {
            case 'POST':
                {
                    return [
                        'pid'  => [
                            'required',
                            'integer',
                            function ($attribute, $value, $fail) {
                                if ($value !== 0 && !UserStoreCategory::find($value)) {
                                    return $fail('该会员行业分类不存在');
                                }
                            },
                        ],
                        'name' => 'required|string|max:50|unique:user_store_category',
                    ];
                }
            case 'PUT':
            case 'PATCH':
                {
                    return [
                        'pid'  => [
                            'required',
                            'integer',
                            function ($attribute, $value, $fail) {
                                if ($value !== 0 && !UserStoreCategory::find($value)) {
                                    return $fail('该会员行业分类不存在');
                                }
                            },
                        ],
                        'name' => [
                            'required',
                            'string',
                            'max:50',
                            Rule::unique('user_store_category')->ignore(request()->userStoreCategory->id),
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
            'pid.required'  => '分类 ID 不能为空',
            'pid.integer'   => '分类 ID 必须是整数类型',
            'name.required' => '分类名称不能为空',
            'name.string'   => '分类名称必须是字符串数据类型',
            'name.max'      => '分类名称最大字符长度不能超过 50 个字符',
            'name.unique'   => '分类名称已经存在',
        ];
    }
}
