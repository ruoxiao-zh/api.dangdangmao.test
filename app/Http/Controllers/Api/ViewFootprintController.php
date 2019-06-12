<?php

namespace App\Http\Controllers\Api;

use App\Models\ViewFootprint;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ViewFootprintController extends Controller
{
    public function addGoodsInfoToFootprint($type, $goodsName, $goodsImage)
    {
        ViewFootprint::create([
            'type'        => $type,
            'goods_name'  => $goodsName,
            'goods_image' => $goodsImage,
        ]);
    }
}
