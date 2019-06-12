<?php

namespace App\Transformers;

use App\Models\ProvinceAndCity;
use League\Fractal\TransformerAbstract;

class ProvinceAndCityTransformer extends TransformerAbstract
{
    public function transform(ProvinceAndCity $provinceAndCity)
    {
        return [
            'id'        => $provinceAndCity->ID,
            'code'      => $provinceAndCity->Code,
            'area_name' => $provinceAndCity->AreaName,
            'leve_name' => $provinceAndCity->LeveName,
        ];
    }
}
