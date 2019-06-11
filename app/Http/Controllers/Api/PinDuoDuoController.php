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
        $result = $this->pinDuoDuoClient->request('pdd.ddk.oauth.top.goods.list.query', [
            'offset'    => $request->offset ?? 0,
            'sort_type' => (int)$request->sort_type,
            'limit'     => $request->limit ?? 20,
        ]);

        return response()->json($result);
    }

    public function ddkGoodsSearch(Request $request)
    {
        $result = $this->pinDuoDuoClient->request('pdd.ddk.goods.search', [
            'keyword' => $request->keyword,
            'page' => $request->page ?? 1,
            'page_size' => 20,
        ]);

        return response()->json($result);
    }
}
