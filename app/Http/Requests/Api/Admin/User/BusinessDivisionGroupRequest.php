<?php

namespace App\Http\Requests\Api\Admin\User;

use App\Http\Requests\Api\BaseRequest;
use App\Models\BusinessDivisionGroup;
use Illuminate\Validation\Rule;

class BusinessDivisionGroupRequest extends BaseRequest
{
    public function rules()
    {
        switch ($this->method()) {
            case 'POST':
                {
                    return [
                        'name'             => 'required|string|max:50|unique:business_division_group',
                        'remark'           => 'required|string',
                        'total_invite_num' => 'required|integer|min:1',
                        'invited_num'      => 'required|integer',
                        'principal_name'   => 'required|string',
                        'principal_phone'  => 'required|phone:CN,mobile|unique:business_division_group',
                    ];
                }
            case 'PUT':
            case 'PATCH':
                {
                    return [
                        'name'             => [
                            'required',
                            'string',
                            'max:50',
                            Rule::unique('business_division_group')->ignore(request()->businessDivisionGroup->id),
                        ],
                        'remark'           => 'required|string',
                        'total_invite_num' => 'required|integer|min:1',
                        'invited_num'      => 'required|integer',
                        'principal_name'   => 'required|string',
                        'principal_phone'  => [
                            'required',
                            'phone:CN,mobile',
                            Rule::unique('business_division_group')->ignore(request()->businessDivisionGroup->id),
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
            'name.required'             => '事业部名称不能为空',
            'name.string'               => '事业部名称必须是字符串数据类型',
            'name.max'                  => '事业部名称最大值不能超过 50 个字符',
            'name.unique'               => '事业部名称已经存在',
            'remark.required'           => '备注不能为空',
            'remark.string'             => '备注必须是字符串数据类型',
            'total_invite_num.required' => '当前月总共邀请名额不能为空',
            'total_invite_num.integer'  => '当前月总共邀请名额必须是整数类型',
            'total_invite_num.min'      => '当前月总共邀请名额不能小于 1 个名额',
            'invited_num.required'      => '当前已使用名额不能为空',
            'invited_num.integer'       => '当前已使用名额不能为空必须是整数类型',
            'principal_name.required'   => '负责人名字不能为空',
            'principal_name.string'     => '负责人名字必须是字符串数据类型',
            'principal_phone.required'  => '负责人电话不能为空',
            'principal_phone.phone'     => '负责人电话格式不正确',
            'principal_phone.unique'    => '负责人电话已经存在, 请确保唯一',
        ];
    }
}
