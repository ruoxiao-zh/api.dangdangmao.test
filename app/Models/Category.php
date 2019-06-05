<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'dangdangmao_categories';

    protected $fillable = [
        'name', 'order',
    ];
    
    public function getCreatedAtDiffForHumansAttribute()
    {
        if ($this->created_at) {
            return $this->created_at->diffForHumans();
        }

        return '';
    }

    public function scopeRecent($query)
    {
        return $query->orderBy('id', 'desc');
    }
}
