<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $table = 'comreceiveinfo';

    protected $primaryKey = 'Id';

    protected $guarded = [];

    public $timestamps = false;
}
