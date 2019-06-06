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

    /**
     * 分类管理
     */
    // 添加
    $api->post('category', 'CategoriesController@store')->name('api.category.store');
    // 更新
    $api->patch('category/{category}', 'CategoriesController@update')->name('api.category.update');
    // 删除
    $api->delete('category/{category}', 'CategoriesController@destroy')->name('api.category.destroy');
    // 列表
    $api->get('categories', 'CategoriesController@index')->name('api.categories.list');
    // 详情
    $api->get('category/{category}', 'CategoriesController@show')->name('api.category.show');


    // 淘宝客
    $api->group(['prefix' => 'tbk'], function ($api) {
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
        // 商品列表
        $api->get('items', 'TaoBaoController@items')->name('tbk.items');
        // 商品详情
        $api->get('item-info', 'TaoBaoController@itemInfo')->name('tbk.item.info');
        // 关联商品推荐列表
        $api->get('recommend-items', 'TaoBaoController@recommendItems')->name('tbk.recommend.items');
        // 阿里妈妈推广券信息查询
        $api->get('coupon', 'TaoBaoController@coupon')->name('tbk.coupon');

        // 淘宝客物料下行
        $api->get('dg-optimus-material', 'TaoBaoController@dgOptimusMaterial')->name('tbk.dg.optimus.material');
        // 通用物料搜索
        $api->get('dg-material-optional', 'TaoBaoController@dgMaterialOptional')->name('tbk.dg.material.optional');
        // 好券清单
        $api->get('dg-item-coupon', 'TaoBaoController@dgItemCoupon')->name('tbk.dg.item.coupon');
        // 淘宝客新用户订单
        // $api->get('dg-newuser-order', 'TaoBaoController@dgNewuserOrder')->name('tbk.dg.newuser.order');
        //

        // 淘宝客返利订单查询
        $api->get('rebate-order', 'TaoBaoController@rebateOrder')->name('tbk.rebate.order');
    });
});
