<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\TaoBaoKe\ItemRequest;
use Illuminate\Http\Request;
use ETaobao\Factory;

require __DIR__ . '/../../../Sdk/Taobao/TopSdk.php';

class TaoBaoController extends Controller
{
    private $taoBaoKeClient;

    public function __construct()
    {
        $config = [
            'appkey'    => env('TAOBAO_APP_KEY', ''),
            'secretKey' => env('TAOBAO_APP_SECRET', ''),
            'format'    => 'json',
            'session'   => '',//授权接口（sc类的接口）需要带上
            'sandbox'   => false,
        ];

        $this->taoBaoKeClient = Factory::Tbk($config);
    }

    public function category()
    {
        $categories = collect([
            '服装', '家居', '数码', '女装', '家电', '潮品',
        ]);
        dd($categories);

        return $this->response->collection($categories);
    }

    public function item(ItemRequest $request)
    {
        $param = [
            'fields'   => 'num_iid,title,pintict_url,small_images,reserve_price,zk_final_price,user_type,provcity,item_url,seller_id,volume,nick',
            'q'        => $request->q,
            'is_tmall' => 'true',
            'platform' => (int)$request->platform,
            'page_no'  => (int)$request->page_no,
        ];
        $res = $this->taoBaoKeClient->item->get($param);

        return response()->json($res);
    }

    public function itemInfo(Request $request)
    {
        $param = [
            'num_iids' => $request->num_iids,
            'platform' => (int)$request->platform,
        ];
        $res = $this->taoBaoKeClient->item->getInfo($param);

        return response()->json($res);
    }
}
