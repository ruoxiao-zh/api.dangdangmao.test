<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Requests\Api\Admin\AuthorizationRequest;
use App\Models\AdminUser;
use App\Transformers\Admin\AdminUserTransformer;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\Controller;

class AuthorizationsController extends Controller
{
    public function store(AuthorizationRequest $request)
    {
        // 验证验证码
        $this->verificationCode($request);

        if ( !$adminUser = AdminUser::whereAccount($request->account)->wherePassword(md5($request->password))->first()) {
            return $this->response->errorUnauthorized('用户名或密码错误');
        }

        $token = auth('admin')->fromUser($adminUser);

        return $this->respondWithToken($token);
    }

    private function verificationCode($request)
    {
        $captchaData = \Cache::get($request->captcha_key);

        if ( !$captchaData) {
            return $this->response->error('图片验证码已失效', 422);
        }

        if ( !hash_equals($captchaData['code'], $request->captcha_code)) {
            // 验证错误就清除缓存
            \Cache::forget($request->captcha_key);

            return $this->response->errorUnauthorized('验证码错误');
        }
    }

    public function update()
    {
        $token = auth('admin')->refresh();

        return $this->respondWithToken($token);
    }

    public function destroy()
    {
        auth('admin')->logout();

        return $this->response->noContent();
    }

    public function me()
    {
        return $this->response->item($this->user(), new AdminUserTransformer());
    }
}
