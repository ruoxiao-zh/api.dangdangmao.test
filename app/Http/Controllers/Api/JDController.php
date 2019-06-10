<?php

namespace App\Http\Controllers\Api;

use ETaobao\Factory;
use Illuminate\Http\Request;
use Jenssegers\Agent\Agent;

class JDController extends Controller
{
    private $JDClient;

    public function __construct()
    {
        $agent = new Agent();
        if ($agent->isiOS()) {
//            $appkey = env('JD_ANDROID_APP_KEY', ''); // AppId
//            $appSecret = env('JD_ANDROID_APP_SECRET_KEY', ''); // 密钥
//            $positionId = env('JD_ANDROID_PID', ''); // 推广位ID
//            'siteId' = ''; // 网站ID,
        } else if ($agent->isAndroidOS()) {
            $appkey = env('JD_ANDROID_APP_KEY', ''); // AppId
            $appSecret = env('JD_ANDROID_APP_SECRET_KEY', ''); // 密钥
            $positionId = env('JD_ANDROID_PROMOTION_ID', ''); // 推广位ID
            $siteId = env('JD_ANDROID_APP_ID', ''); // 网站ID,
        } else {
            $appkey = env('JD_ANDROID_APP_KEY', ''); // AppId
            $appSecret = env('JD_ANDROID_APP_SECRET_KEY', ''); // 密钥
            $positionId = env('JD_ANDROID_PROMOTION_ID', ''); // 推广位ID
            $siteId = env('JD_ANDROID_APP_ID', ''); // 网站ID,
        }

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
    }

    public function promotionGoodsInfo(Request $request)
    {
        $this->validate($request, [
            'skuIds' => 'required|string',
        ], [
            'skuIds.required' => '京东 skuID 串不能为空',
            'skuIds.string'   => '京东 skuID 串必须是字符串数据类型',
        ]);
        $res = $this->JDClient->good->info($request->skuIds);

        $result = [];
        if ($res) {
            $result['data'] = $res;
        }

        return response()->json($result);
    }

    public function goodsCategory(Request $request)
    {
        $this->validate($request, [
            'parentId' => 'required|integer',
            'grade'    => 'required|integer',
        ], [
            'parentId.required' => '父类目 id 不能为空',
            'parentId.integer'  => '父类目 id 必须是整数类型',
            'grade.required'    => '类目级别不能为空',
            'grade.integer'     => '类目级别必须是整数类型',
        ]);

        $res = $this->JDClient->good->category((int)$request->parentId, (int)$request->grade);

        $result = [];
        if ($res) {
            $result['data'] = $res;
        }

        return response()->json($result);
    }

//    public function userPid(Request $request)
//    {
//        $this->validate($request, [
//            'parentId' => 'required|integer',
//            'grade'    => 'required|integer',
//        ], [
//            'parentId.required' => '父类目 id 不能为空',
//            'parentId.integer'  => '父类目 id 必须是整数类型',
//            'grade.required'    => '类目级别不能为空',
//            'grade.integer'     => '类目级别必须是整数类型',
//        ]);
//
//        $res = $this->JDClient->good->category((int)$request->parentId, (int)$request->grade);
//
//        $result = [];
//        if ($res) {
//            $result['data'] = $res;
//        }
//
//        return response()->json($result);
//    }

    public function commonPromotion(Request $request)
    {
        $this->validate($request, [
            'materialId' => 'required|string',
        ], [
            'materialId.required' => '推广物料 URL 不能为空',
            'materialId.string'   => '推广物料 URL 必须是字符串类型',
        ]);

        $res = $this->JDClient->link->get($request->materialId, [
            'siteId' => env('JD_ANDROID_APP_ID', ''),
            'positionId' => env('JD_ANDROID_PROMOTION_ID'),
        ]);

//        $result = [];
//        if ($res) {
//            $result['data'] = $res;
//        }

        return response()->json($res);
    }

    public function goodsJingfen(Request $request)
    {
        $this->validate($request, [
            'eliteId'   => 'required|integer',
            'pageIndex' => 'required|integer',
        ], [
            'eliteId.required' => '频道 ID 不能为空',
            'eliteId.integer'  => '频道 ID 必须是整数类型',
            'pageIndex.required' => '页码不能为空',
            'pageIndex.integer'  => '页码必须是整数类型',
        ]);

        $res = $this->JDClient->good->jingfen($request->eliteId, $request->pageIndex, 20);

        return response()->json($res);
    }
}
