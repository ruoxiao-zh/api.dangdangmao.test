<?php

namespace App\Http\Controllers\Api\Handler;

use App\Http\Requests\Api\Handler\ImageUploadHandlerRequest;
use App\Http\Controllers\Api\Controller;
use Illuminate\Support\Facades\Storage;

class ImageUploadHandlerController extends Controller
{
    // 允许上传图片类型
    protected $allowed_ext = ['png', 'jpg', 'gif', 'jpeg'];

    private function save($file, $folder)
    {
        // 文件夹，值如：uploads/images/avatars/201709/21/
        $folderName = "images/$folder/" . date('Ym/d', time());
        // 文件后缀名
        $extension = strtolower($file->getClientOriginalExtension()) ?: 'png';
        // 拼接文件名
        $filename = time() . '_' . str_random(10) . '.' . $extension;

        if ( !in_array($extension, $this->allowed_ext)) {
            return $this->response->error("上传的文件格式必须是 'png', 'jpg', 'gif', 'jpeg' 格式类型", 422);
        }

        // 阿里 OSS 图片上传
        $disk = Storage::disk('oss');
        $imageFullName = $folderName . '/' . $filename;
        $result = $disk->put($imageFullName, file_get_contents($file->getRealPath()));
        if ($result && $path = $disk->getUrl($imageFullName)) {
            $path = str_replace('http://', 'https://', $path);

            return $this->response->array(['path' => $path])->setStatusCode(201);
        }

        return $this->response->error('图片上传失败', 422);
    }

    // 图片上传
    public function upload(ImageUploadHandlerRequest $request)
    {
        return $this->save($request->image, $request->dirname);
    }
}
