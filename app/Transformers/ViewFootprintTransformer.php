<?php

namespace App\Transformers;

use App\Models\ViewFootprint;
use League\Fractal\TransformerAbstract;

class ViewFootprintTransformer extends TransformerAbstract
{
    public function transform(ViewFootprint $viewFootprint)
    {
        return [
            'id'          => $viewFootprint->id,
            'type'        => $viewFootprint->type,
            'type_name'   => $viewFootprint->typeName(),
            'goods_id'    => $viewFootprint->goods_id,
            'goods_name'  => $viewFootprint->goods_name,
            'goods_image' => $viewFootprint->goods_image,
            'item_url'    => $viewFootprint->item_url,
            'member_id'   => $viewFootprint->member_id,
        ];
    }
}
