<?php

namespace App\Http\Requests\Api\Handler;

use App\Http\Requests\Api\BaseRequest;

class ImageUploadHandlerRequest extends BaseRequest
{
    public function rules()
    {
        return [
            'avatar'  => 'mimes:jpg,jpeg,bmp,png,gif|dimensions:min_width=80,min_height=80',
            'dirname' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'images.mimes'      => '图片必须是 jpg, jpeg, bmp, png, gif 格式',
            'images.dimensions' => '图片的清晰度不够，宽和高需要 80px 以上',
            'dirname.required'  => '文件上传文件夹必能为空',
        ];
    }
}
