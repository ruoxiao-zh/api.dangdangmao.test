<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Justmd5\DuoDuoKe\DuoDuoKe;

class PinDuoDuoController extends Controller
{
    private $pinDuoDuoClient;

    public function __construct()
    {
        $config = [
            'key'    => env('PINDUODUO_CLIENT_ID', ''),
            'secret' => env('PINDUODUO_CLIENT_SECRET', ''),
            'debug'  => true,
        ];

        $this->pinDuoDuoClient = new DuoDuoKe($config);
    }

    public function goodsCats(Request $request)
    {
        $result = $this->pinDuoDuoClient->request('pdd.goods.cats.get', [
            'parent_cat_id' => $request->parent_cat_id ?? 0,
        ]);

        return response()->json($result);
    }

    public function goodsOpt(Request $request)
    {
        $result = $this->pinDuoDuoClient->request('pdd.goods.opt.get', [
            'parent_opt_id' => $request->parent_cat_id ?? 0,
        ]);

        return response()->json($result);
    }

//    public function zsUnitGoods(Request $request)
//    {
//        $result = $this->pinDuoDuoClient->request('pdd.ddk.zs.unit.goods.query', [
//            'zs_duo_id' => $request->parent_cat_id ?? 0
//        ]);
//
//        return response()->json($result);
//    }

    public function oauthTopGoodsList(Request $request)
    {
//        $this->validate($request, [
//            'sort_type' => 'required|integer',
//        ], [
//            'sort_type.required' => '',
//            'sort_type.integer' => '',
//        ]);

        $result = $this->pinDuoDuoClient->request('pdd.ddk.oauth.top.goods.list.query', [
            'offset'    => $request->offset ?? 0,
            'sort_type' => (int)$request->sort_type,
            'limit'     => $request->limit ?? 20,
        ]);

        return response()->json($result);
    }

    public function ddkGoodsSearch(Request $request)
    {
        $this->validate($request, [
            'keyword' => 'required|string',
        ], [
            'keyword.required' => '商品关键词不能为空',
            'keyword.string'   => '商品关键词必须是字符串数据类型',
        ]);

        $result = $this->pinDuoDuoClient->request('pdd.ddk.goods.search', [
            'keyword'   => $request->keyword,
            'page'      => $request->page ?? 1,
            'page_size' => 20,
        ]);

        return response()->json($result);
    }

    public function ddkCouponInfo(Request $request)
    {

    }

    public function goodsBasicInfo(Request $request)
    {
        $this->validate($request, [
            'goods_id_list' => 'required|string',
        ], [
            'goods_id_list.required' => '商品 ID 不能为空',
            'goods_id_list.string'   => '商品 ID 必须是字符串数据类型',
        ]);

        $result = $this->pinDuoDuoClient->request('pdd.ddk.goods.basic.info.get', [
            'goods_id_list' => $request->goods_id_list,
        ]);

        return response()->json($result);
    }

    public function orderDetail(Request $request)
    {
        $this->validate($request, [
            'order_sn' => 'required|string',
        ], [
            'order_sn.required' => '订单号不能为空',
            'order_sn.string'   => '订单号必须是字符串数据类型',
        ]);

        $result = $this->pinDuoDuoClient->request('pdd.ddk.order.detail.get', [
            'order_sn' => $request->order_sn,
        ]);

        return response()->json($result);
    }

    public function directGoods(Request $request)
    {
        $this->validate($request, [
            'page' => 'required|integer',
        ], [
            'page.required' => '商品分页数不能为空',
            'page.integer'  => '商品分页数必须是整数数据类型',
        ]);

        $result = $this->pinDuoDuoClient->request('pdd.ddk.direct.goods.query', [
            'page'      => (int)$request->page,
            'page_size' => $request->page_size ?? 20,
        ]);

        return response()->json($result);
    }
}
