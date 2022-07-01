<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Sqits\UserStamps\Concerns\HasUserStamps;

class CategoryMenu extends Model
{
    use SoftDeletes,
        HasUserStamps;

    protected $guarded = [];

    public function scopePositioned($query, $ascending = true)
    {
        return $query->orderBy('position', $ascending ? 'asc' : 'desc');
    }

    public function category()
    {
        return $this->belongsTo('App\Category');
    }
}
