<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\TaoBaoKe\ItemRequest;
use Illuminate\Http\Request;
use ETaobao\Factory;
use Illuminate\Validation\Rule;
use Jenssegers\Agent\Agent;

require __DIR__ . '/../../../Sdk/Taobao/TopSdk.php';

class TaoBaoController extends Controller
{
    private $taoBaoKeClient;

    public function __construct()
    {
//        $agent = new Agent();
//        if ($agent->isiOS()) {
//            $appkey = env('TAOBAO_IOS_APP_KEY', '');
//            $secretKey = env('TAOBAO_IOS_APP_SECRET', '');
//        } else if ($agent->isAndroidOS()) {
//            $appkey = env('TAOBAO_ANDROID_APP_KEY', '');
//            $secretKey = env('TAOBAO_ANDROID_APP_SECRET', '');
//        } else {
//            $appkey = env('TAOBAO_PC_APP_KEY', '');
//            $secretKey = env('TAOBAO_PC_APP_SECRET', '');
//        }

        switch (request()->device) {
            case 'Android':
                $appkey = env('TAOBAO_ANDROID_APP_KEY', '');
                $secretKey = env('TAOBAO_ANDROID_APP_SECRET', '');
                break;
            case 'iOS':
                $appkey = env('TAOBAO_IOS_APP_KEY', '');
                $secretKey = env('TAOBAO_IOS_APP_SECRET', '');
                break;
            case 'PC':
                $appkey = env('TAOBAO_PC_APP_KEY', '');
                $secretKey = env('TAOBAO_PC_APP_SECRET', '');
                break;
            default:
                $appkey = env('TAOBAO_PC_APP_KEY', '');
                $secretKey = env('TAOBAO_PC_APP_SECRET', '');
        }

        $config = [
            'appkey'    => $appkey,
            'secretKey' => $secretKey,
            'format'    => 'json',
            'session'   => '',  // 授权接口（sc类的接口）需要带上
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

        // 浏览记录
        if ($goodsInfo = $res->results->n_tbk_item) {
            (new ViewFootprintController())->addGoodsInfoToFootprint(1, ($goodsInfo[0])->title,
                ($goodsInfo[0])->pict_url, ($goodsInfo[0])->num_iid, ($goodsInfo[0])->item_url);
        }

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
            // 'q'        => 'required',
            'platform' => [
                'required',
                Rule::in([1, 2]),
            ],
        ], [
            // 'q.required'        => '商品查询词不能为空',
            'platform.required' => '链接形式不能为空',
            'platform.in'       => '链接形式只能是 [1, 2] 中的一个值',
        ]);

        $adzone_id = explode('_', env('TAOBAO_PC_PID'))[3];

        $param = [
            'adzone_id'  => $adzone_id,
            'is_tmall'   => $request->is_tmall,
            'q'          => $request->q,
            'page_no'    => (int)$request->page_no,
            'platform'   => (int)$request->platform,
            'has_coupon' => 'true',
            'sort'       => $request->sort,
        ];
        $res = $this->taoBaoKeClient->dg->materialOptional($param);

        return response()->json($res);
    }

    public function dgOptimusMaterial(Request $request)
    {
        $param = [
            'adzone_id'   => explode('_', env('TAOBAO_PC_PID'))[3],
            'material_id' => (int)$request->material_id,
            'page_no'     => (int)$request->page_no,
        ];
        $res = $this->taoBaoKeClient->dg->materialOptimus($param);

        return response()->json($res);
    }

    public function dgItemCoupon(Request $request)
    {
        $param = [
            'adzone_id' => explode('_', env('TAOBAO_PC_PID'))[3],
            'platform'  => (int)$request->platform,
            'q'         => $request->q,
            'page_no'   => (int)$request->page_no,
            'page_size' => 100,
        ];
        $res = $this->taoBaoKeClient->dg->getCoupon($param);

        // 添加搜索记录
        $this->addSearchKeywordsToCache($request->q);

        return response()->json($res);
    }

//    public function dgNewuserOrder(Request $request)
//    {
//        $param = [
//            'fields'     => 'tb_trade_parent_id,tb_trade_id,num_iid,item_title,item_num,price,pay_price,seller_nick,seller_shop_title,commission,commission_rate,unid,create_time,earning_time',
//            'start_time' => '2015-03-05 13:52:08',
//            'span'       => 600,
//            'page_no'    => (int)$request->page_no,
//        ];
//        $res = $this->taoBaoKeClient->dg->getOrderNewUser($param);
//
//        return response()->json($res);
//    }

    public function rebateOrder(Request $request)
    {
        $this->validate($request, [
            'start_time' => 'required|string',
        ], [
            'start_time.required' => '订单结算开始时间不能为空',
            'start_time.string'   => '订单结算开始时间必须是字符串数据类型',
        ]);
        $param = [
            'fields'     => 'tb_trade_parent_id,tb_trade_id,num_iid,item_title,item_num,price,pay_price,seller_nick,seller_shop_title,commission,commission_rate,unid,create_time,earning_time,tk3rd_pub_id,tk3rd_site_id,tk3rd_adzone_id,relation_id,tb_trade_parent_id,tb_trade_id,num_iid,item_title,item_num,price,pay_price,seller_nick,seller_shop_title,commission,commission_rate,unid,create_time,earning_time,tk3rd_pub_id,tk3rd_site_id,tk3rd_adzone_id,special_id,click_time',
            'start_time' => $request->time,
            'span'       => 60,
            'page_no'    => (int)$request->page_no,
        ];
        $res = $this->taoBaoKeClient->order->get($param);

        return response()->json($res);
    }
}
