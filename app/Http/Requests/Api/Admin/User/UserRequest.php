<?php

namespace App\Http\Requests\Api\Admin\User;

use App\Http\Requests\Api\BaseRequest;

class UserRequest extends BaseRequest
{
    public function rules()
    {
        switch ($this->method()) {
            case 'POST':
                {
//                    return [
//                        'Mobile' => 'required|phone:CN,mobile|unique:usermsg',
//                    ];
                }
            case 'PUT':
            case 'PATCH':
                {
                    return [
                        'IsAudit'           => 'required|integer',
                        'is_integral_store' => 'required|integer',
                        'is_operation'      => 'required|integer',
                        'refuse_reason'     => 'sometimes',
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
            'IsAudit.required'           => '是否审核不能为空',
            'IsAudit.integer'            => '是否审核必须是整数类型',
            'is_integral_store.required' => '是否开通了积分商城不能为空',
            'is_integral_store.integer'  => '是否开通了积分商城必须是整数类型',
            'is_operation.required'      => '是否有运营能力不能为空',
            'is_operation.integer'       => '是否有运营能力必须是整数类型',
        ];
    }
}
