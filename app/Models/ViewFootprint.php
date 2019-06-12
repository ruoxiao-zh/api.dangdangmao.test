<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ViewFootprint extends Model
{
    protected $table = 'dangdangmao_view_footprint';

    protected $guarded = [];

    public $timestamps = false;

    public function scopeRecent($query)
    {
        return $query->orderBy('Id', 'desc');
    }
}
