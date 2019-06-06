<?php

namespace App\Models;

use EloquentFilter\Filterable;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements JWTSubject
{
    use Notifiable, Filterable;

    protected $table = 'member';

    public $timestamps = false;

    protected $guarded = [];

    protected $primaryKey = 'ID';

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }

    public function scopeRecent($query)
    {
        return $query->orderBy('ID', 'desc');
    }
    
    // 积分
    public function integral()
    {
        
    }
}
