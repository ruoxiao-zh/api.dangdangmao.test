<?php

namespace App\Http\Controllers\H5;

use App\Http\Controllers\Api\TaoBaoController;
use ETaobao\Factory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Justmd5\DuoDuoKe\DuoDuoKe;

class IndexController extends Controller
{
    private $taoBaoKeClient;

    private $JDClient;

    private $pinDuoDuoClient;

    public function index(Request $request)
    {
        $taoBaoKe = $this->taoBaoClientResult($request);
        $taoBaoKeCoupons = $taoBaoKe->results->tbk_coupon;

        $jd = $this->jdClientResult($request);
        $jdData = $jd['data'];

        $pinDuoDuo = $this->pinDuoDuoClient($request);
        $pinDuoDuoData = $pinDuoDuo['goods_search_response']['goods_list'];

        return view('h5.index', compact('taoBaoKeCoupons', 'jdData', 'pinDuoDuoData'));
    }

    private function taoBaoClientResult(Request $request)
    {
        $appkey = env('TAOBAO_PC_APP_KEY', '');
        $secretKey = env('TAOBAO_PC_APP_SECRET', '');
        $config = [
            'appkey'    => $appkey,
            'secretKey' => $secretKey,
            'format'    => 'json',
            'session'   => '',  // 授权接口（sc类的接口）需要带上
            'sandbox'   => false,
        ];

        $this->taoBaoKeClient = Factory::Tbk($config);

        $param = [
            'adzone_id' => explode('_', env('TAOBAO_PC_PID'))[3],
            'platform'  => 1,
            'page_no'   => 1,
            'page_size' => 100,
        ];

        return $this->taoBaoKeClient->dg->getCoupon($param);
    }

    private function jdClientResult(Request $request)
    {
        $appkey = env('JD_ANDROID_APP_KEY', ''); // AppId
        $appSecret = env('JD_ANDROID_APP_SECRET_KEY', ''); // 密钥
        $positionId = env('JD_ANDROID_PROMOTION_ID', ''); // 推广位ID
        $siteId = env('JD_ANDROID_APP_ID', ''); // 网站ID,

        $config = [
            'appkey'     => $appkey, // AppId
            'appSecret'  => $appSecret, // 密钥
            'unionId'    => 1001558867, // 联盟ID
            'positionId' => $positionId, // 推广位ID
            'siteId'     => $siteId, // 网站ID,
            'apithId'    => '',  // 第三方网站Apith的appid （可选，不使用apith的，可以不用填写）
            'apithKey'   => '', // 第三方网站Apith的appSecret (可选，不使用apith的，可以不用填写)
            'isCurl'     => true // 设置为true的话，强制使用php的curl，为false的话，在swoole cli环境下自动启用 http协程客户端
        ];

        $this->JDClient = new \JdMediaSdk\JdFatory($config);

        return $this->JDClient->good->jingfen(1, 1, 50);
    }

    private function pinDuoDuoClient(Request $request)
    {
        $config = [
            'key'    => env('PINDUODUO_CLIENT_ID', ''),
            'secret' => env('PINDUODUO_CLIENT_SECRET', ''),
            'debug'  => true,
        ];

        $this->pinDuoDuoClient = new DuoDuoKe($config);

        return $this->pinDuoDuoClient->request('pdd.ddk.goods.search', [
            'keyword'   => '美妆',
            'page'      => $request->page ?? 1,
            'page_size' => 100,
        ]);
    }
}
