<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

$api = app('Dingo\Api\Routing\Router');

$api->version('v1', [
    'namespace'  => 'App\Http\Controllers\Api',
    'middleware' => [
        'serializer:array',
        'bindings',
        'cors',
        'change-locale',
    ],
], function ($api) {
    $api->group(['prefix' => 'admin'], function ($api) {
//        // 管理员登录图片验证码
//        $api->post('authorizations/captchas', 'CaptchasController@store')
//            ->name('api.authorizations.captchas');
//        // 管理员登录
//        $api->post('authorizations/login', 'AuthorizationsController@store')
//            ->name('api.authorizations.login');
//        // 刷新 JWT 令牌
//        $api->put('authorizations/current', 'AuthorizationsController@update')
//            ->name('api.authorizations.current');
//        // 管理员登出
//        $api->delete('authorizations/current', 'AuthorizationsController@destroy')
//            ->name('api.authorizations.destroy');
    });
});
