<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $table = 'comreceiveinfo';

    protected $primaryKey = 'Id';

    protected $guarded = [];

    public $timestamps = false;

    public function scopeRecent($query)
    {
        return $query->orderBy('Id', 'desc');
    }

    public function completeAddress()
    {
        return ProvinceAndCity::whereCode($this->Province)->value('AreaName') .
            ProvinceAndCity::whereCode($this->City)->value('AreaName') .
            ProvinceAndCity::whereCode($this->County)->value('AreaName') .
            $this->Address;
    }
}
