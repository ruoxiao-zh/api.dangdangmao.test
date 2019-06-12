<?php

namespace App\Http\Controllers\Api;

use App\Models\ViewFootprint;
use App\Transformers\ViewFootprintTransformer;
use Illuminate\Http\Request;

class ViewFootprintController extends Controller
{
    public function addGoodsInfoToFootprint($type, $goodsName, $goodsImage, $goodsId, $itemUrl)
    {
        if ($this->user()) {
            ViewFootprint::firstOrCreate([
                'type'        => $type,
                'goods_name'  => $goodsName,
                'goods_image' => $goodsImage,
                'goods_id'    => $goodsId,
                'item_url'    => $itemUrl,
                'member_id'   => $this->user()->ID,
            ]);
        }
    }

    public function index()
    {
        $viewFootprint = ViewFootprint::where('member_id', $this->user->ID)->recent()->paginate();

        return $this->response->paginator($viewFootprint, new ViewFootprintTransformer());
    }
}
