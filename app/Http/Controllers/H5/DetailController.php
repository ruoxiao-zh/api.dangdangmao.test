<?php

namespace App\Http\Controllers\H5;

use ETaobao\Factory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DetailController extends Controller
{
    private $taoBaoKeClient;

    private $JDClient;

    private $pinDuoDuoClient;

    public function index(Request $request)
    {
        $type = $request->type;

        switch ($request->type) {
            case 'taobao':
                $taoBaoKe = $this->taoBaoClientResult($request);
                $taoBaoKeInfo = $taoBaoKe->results->n_tbk_item;
                dump($taoBaoKeInfo);

                return view('h5.detail', compact('type', 'taoBaoKeInfo'));
            case 'jd':

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
}
