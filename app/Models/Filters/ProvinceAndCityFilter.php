<?php namespace App\Models\Filters;

use EloquentFilter\ModelFilter;

class ProvinceAndCityFilter extends ModelFilter
{
    public $relations = [];

    public function areaLevel($areaLevel)
    {
        return $this->where('AreaLevel', $areaLevel);
    }

    public function parentCode($parentCode)
    {
        return $this->where('ParentCode', (int)$parentCode);
    }
}
