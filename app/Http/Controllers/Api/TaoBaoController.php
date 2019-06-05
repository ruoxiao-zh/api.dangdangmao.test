<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\TaoBaoKe\ItemRequest;
use Illuminate\Http\Request;
use ETaobao\Factory;
use Illuminate\Validation\Rule;

require __DIR__ . '/../../../Sdk/Taobao/TopSdk.php';

class TaoBaoController extends Controller
{
    private $taoBaoKeClient;

    public function __construct()
    {
        $config = [
            'appkey'    => env('TAOBAO_IOS_APP_KEY', ''),
            'secretKey' => env('TAOBAO_IOS_APP_SECRET', ''),
            'format'    => 'json',
            'session'   => '',  //授权接口（sc类的接口）需要带上
            'sandbox'   => false,
        ];

        $this->taoBaoKeClient = Factory::Tbk($config);
    }

    public function items(ItemRequest $request)
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
        $this->validate($request, [
            'num_iids' => 'required',
            'platform' => [
                'required',
                Rule::in([1, 2]),
            ],
        ], [
            'num_iids.required' => '商品 ID 不能为空',
            'platform.required' => '链接形式不能为空',
            'platform.in'       => '链接形式只能是 [1, 2] 中的一个值',
        ]);

        $param = [
            'num_iids' => $request->num_iids,
            'platform' => (int)$request->platform,
        ];
        $res = $this->taoBaoKeClient->item->getInfo($param);

        return response()->json($res);
    }

    public function recommendItems(Request $request)
    {
        $this->validate($request, [
            'num_iid'  => 'required',
            'platform' => [
                'required',
                Rule::in([1, 2]),
            ],
        ], [
            'num_iid.required'  => '商品 ID 不能为空',
            'platform.required' => '链接形式不能为空',
            'platform.in'       => '链接形式只能是 [1, 2] 中的一个值',
        ]);

        $param = [
            'fields'   => 'num_iid,title,pict_url,small_images,reserve_price,zk_final_price,user_type,provcity,item_url',
            'num_iid'  => $request->num_iid,
            'count'    => $request->count ?? 20,
            'platform' => (int)$request->platform,
        ];
        $res = $this->taoBaoKeClient->item->getRecommend($param);

        return response()->json($res);
    }

    public function coupon(Request $request)
    {
        $this->validate($request, [
            'item_id'     => 'required',
            'activity_id' => 'required',
        ], [
            'item_id.required'     => '商品 ID 不能为空',
            'activity_id.required' => '优惠券 ID 不能为空',
        ]);

        $param = [
            'item_id'     => $request->item_id,
            'activity_id' => $request->activity_id,
        ];

        $res = $this->taoBaoKeClient->coupon->get($param);

        return response()->json($res);
    }

    public function dgMaterialOptional(Request $request)
    {
        $this->validate($request, [
            'q'        => 'required',
            'platform' => [
                'required',
                Rule::in([1, 2]),
            ],
        ], [
            'q.required'        => '商品查询词不能为空',
            'platform.required' => '链接形式不能为空',
            'platform.in'       => '链接形式只能是 [1, 2] 中的一个值',
        ]);

        $adzone_id = explode('_', env('TAOBAO_IOS_PID'))[3];

        $param = [
            'adzone_id'  => $adzone_id,
            'is_tmall'   => 'true',
            'q'          => $request->q,
            'page_no'    => (int)$request->page_no,
            'platform'   => (int)$request->platform,
            'has_coupon' => 'true',
        ];
        $res = $this->taoBaoKeClient->dg->materialOptional($param);

        return response()->json($res);
    }
}
