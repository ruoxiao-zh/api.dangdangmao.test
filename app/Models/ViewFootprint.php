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

    public function typeName()
    {
        // 类型 (1: 淘宝 2:京东 3: 拼多多)
        switch ($this->type) {
            case 1:
                return '淘宝';
                break;
            case 2:
                return '京东';
                break;
            case 3:
                return '拼多多';
                break;
            default:
                return '';
        }
    }
}
