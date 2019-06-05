<?php

namespace App\Http\Requests\Api;

use Illuminate\Validation\Rule;

class CategoryRequest extends BaseRequest
{
    public function rules()
    {
        switch ($this->method()) {
            case 'POST':
                {
                    return [
                        'name'  => 'required|string|max:50|unique:dangdangmao_categories',
                        'order' => 'required|integer|min:1',
                    ];
                }
            case 'PUT':
            case 'PATCH':
                {
                    return [
                        'name' => [
                            'required',
                            'string',
                            'max:50',
                            Rule::unique('dangdangmao_categories')->ignore(request()->category->id),
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
            'name.required'  => '分类名称不能为空',
            'name.string'    => '分类名称必须是字符串数据类型',
            'name.max'       => '分类名称最大长度为 50',
            'name.unique'    => '分类名称已经存在',
            'order.required' => '排序不能为空',
            'order.integer'  => '排序必须是整数',
            'order.min'      => '排序的最小不能低于 1',
        ];
    }
}
