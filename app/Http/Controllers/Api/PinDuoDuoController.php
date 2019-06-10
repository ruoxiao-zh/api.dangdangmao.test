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
            'parent_cat_id' => $request->parent_cat_id ?? 0
        ]);

        return response()->json($result);
    }
}
