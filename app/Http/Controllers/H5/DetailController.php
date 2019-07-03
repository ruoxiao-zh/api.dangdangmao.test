<?php

namespace App\Http\Controllers\H5;

use ETaobao\Factory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Justmd5\DuoDuoKe\DuoDuoKe;

class DetailController extends Controller
{
    private $taoBaoKeClient;

    private $JDClient;

    private $pinDuoDuoClient;

    public function index(Request $request)
    {
        $param = $request->all();

        switch ($request->type) {
            case 'taobao':
                $taoBaoKe = $this->taoBaoClientResult($request);
                $taoBaoKeInfo = $taoBaoKe->results->n_tbk_item;

                return view('h5.detail', compact('param', 'taoBaoKeInfo'));
            case 'pinduoduo':
                $pinDuoDuo = $this->pinDuoDuoClient($request);
                $pinDuoDuoInfo = $pinDuoDuo['goods_basic_detail_response']['goods_list'][0];

                $pinDuoDuoShare = $this->pinDuoDuoClientShare($request);
                $pinDuoDuoShareData = $pinDuoDuoShare['goods_promotion_url_generate_response']['goods_promotion_url_list'][0];

                return view('h5.detail', compact('param', 'pinDuoDuoInfo', 'pinDuoDuoShareData'));
            case 'jd':
                $jd = $this->jdClientResult($request);
                $jdData = $jd[0];

                $couponInfo = urldecode($request->couponInfo);
                $couponInfo = json_decode($couponInfo, true);

                return view('h5.detail', compact('param', 'jdData', 'couponInfo'));
        }

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
            'num_iids' => $request->num_iids,
            'platform' => 1,
        ];

        return $this->taoBaoKeClient->item->getInfo($param);
    }

    private function pinDuoDuoClient(Request $request)
    {
        $config = [
            'key'    => env('PINDUODUO_CLIENT_ID', ''),
            'secret' => env('PINDUODUO_CLIENT_SECRET', ''),
            'debug'  => true,
        ];

        $this->pinDuoDuoClient = new DuoDuoKe($config);

        return $this->pinDuoDuoClient->request('pdd.ddk.goods.basic.info.get', [
            'goods_id_list' => [$request->goods_id_list],
        ]);
    }

    private function pinDuoDuoClientShare(Request $request)
    {
        $config = [
            'key'    => env('PINDUODUO_CLIENT_ID', ''),
            'secret' => env('PINDUODUO_CLIENT_SECRET', ''),
            'debug'  => true,
        ];

        $this->pinDuoDuoClient = new DuoDuoKe($config);

        return $this->pinDuoDuoClient->request('pdd.ddk.goods.promotion.url.generate', [
            'p_id'          => env('PINDUODUO_PID', ''),
            'goods_id_list' => [$request->goods_id_list],
        ]);
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

        return $this->JDClient->good->info($request->skuIds);;
    }
}
