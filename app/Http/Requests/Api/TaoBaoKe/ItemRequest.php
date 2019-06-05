<?php

namespace App\Http\Requests\Api\TaoBaoKe;

use App\Http\Requests\Api\BaseRequest;
use Illuminate\Validation\Rule;

class ItemRequest extends BaseRequest
{
    public function rules()
    {
        return [
            'q'        => 'required',
            'platform' => [
                'required',
                'integer',
                Rule::in([1, 2]),
            ],
            'page_no'  => 'required|integer|min:1',
        ];
    }

    public function messages()
    {
        return [
            'q.required'        => '查询词不能为空',
            'platform.required' => '链接形式不能为空',
            'platform.integer'  => '链接形式必须是整数类型',
            'platform.in'       => '链接形式只能是 [1,2] 中的一个值',
            'page_no.required'  => '第几页不能为空',
            'page_no.integer'   => '第几页必须是整数类型',
            'page_no.min'       => '第几页最小值为 1',
        ];
    }
}
