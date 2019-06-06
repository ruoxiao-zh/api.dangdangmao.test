<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Transformers\UserTransformer;
use App\Http\Requests\Api\AuthorizationRequest;

class AuthorizationsController extends Controller
{
    public function store(AuthorizationRequest $request)
    {
        // 验证验证码
        // $this->verificationCode($request);

        if ( !$user = User::where('UserId', $request->phone)->wherePassword(md5($request->password))->first()) {
            return $this->response->errorUnauthorized('用户名或密码错误');
        }

        $token = auth('api')->fromUser($user);

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
        $token = auth('api')->refresh();

        return $this->respondWithToken($token);
    }

    public function destroy()
    {
        auth('api')->logout();

        return $this->response->noContent();
    }

    public function me()
    {
        return $this->response->item($this->user(), new UserTransformer());
    }
}
