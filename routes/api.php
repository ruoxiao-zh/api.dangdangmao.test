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

    // 登录图片验证码
//    $api->post('authorizations/captchas', 'CaptchasController@store')
//        ->name('api.authorizations.captchas');
    // 登录
    $api->post('authorizations/login', 'AuthorizationsController@store')
        ->name('api.authorizations.login');
    // 刷新 JWT 令牌
    $api->put('authorizations/current', 'AuthorizationsController@update')
        ->name('api.authorizations.current');
    // 登出
    $api->delete('authorizations/current', 'AuthorizationsController@destroy')
        ->name('api.authorizations.destroy');

    // 淘宝客
    $api->group(['middleware' => 'api.auth'], function ($api) {
        // 用户详情
        $api->get('authorizations/me', 'AuthorizationsController@me')
            ->name('api.authorizations.,me');
    });

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

    // 京东
    $api->group(['prefix' => 'jd'], function ($api) {
        // 订单查询接口
        $api->get('order', 'JDController@order')->name('jd.order');
        // 获取推广商品信息
        $api->get('promotion-goods-info', 'JDController@promotionGoodsInfo')->name('jd.promotion.goods.info');
        // 商品类目查询
        $api->get('goods-category', 'JDController@goodsCategory')->name('jd.goods.category');
        // 获取 PID
        $api->get('user-pid', 'JDController@userPid')->name('jd.user.pid');
        // 通用推广链接
        $api->get('common-promotion', 'JDController@commonPromotion')->name('jd.common.promotion');
        // 京粉精选商品查询接口
        $api->get('goods-jingfen', 'JDController@goodsJingfen')->name('jd.goods.jingfen');
        // 关键词商品查询
        // $api->get('goods', 'JDController@goods')->name('jd.goods');
    });

    // 拼多多
    $api->group(['prefix' => 'pdd'], function ($api) {
        // 商品列表
        $api->get('goods-cats', 'PinDuoDuoController@goodsCats')->name('pdd.ddk.goods.cats');
        // 商品标签列表
        $api->get('goods-opt', 'PinDuoDuoController@goodsOpt')->name('pdd.ddk.goods.opt');
        // 招商推广计划商品
        $api->get('ddk-zs-unit-goods', 'PinDuoDuoController@zsUnitGoods')->name('pdd.ddk.zs.unit.goodss');
        // 获取爆款排行商品接口
        // $api->get('ddk-oauth-top-goods-list', 'PinDuoDuoController@oauthTopGoodsList')->name('pdd.ddk.oauth.top.goods.list');
        // 多多进宝商品查询
        $api->get('ddk-goods-search', 'PinDuoDuoController@ddkGoodsSearch')->name('ddk.goods.search');
        // 查询优惠券信息
        $api->get('ddk-coupon-info', 'PinDuoDuoController@ddkCouponInfo')->name('ddk.coupon.info');
        // 获取商品基本信息
        $api->get('ddk-goods-basic-info', 'PinDuoDuoController@goodsBasicInfo')->name('ddk.goods.basic.info');
        // 查询订单详情
        $api->get('ddk-order-detail', 'PinDuoDuoController@orderDetail')->name('ddk.order.detail');
        // 定向推广商品
        // $api->get('ddk-direct-goods', 'PinDuoDuoController@directGoods')->name('ddk.direct.goods');
    });
});
