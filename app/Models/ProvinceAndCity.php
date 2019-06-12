<?php

namespace App\Models;

use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\Model;

class ProvinceAndCity extends Model
{
    use Filterable;

    protected $table = 'provincecitycounty';
}
