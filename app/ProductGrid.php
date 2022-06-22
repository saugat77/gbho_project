<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductGrid extends Model
{
    protected $guarded = [];

    protected $casts = [
        'active' => 'boolean',
    ];

    public function scopePositioned($query, $ascending = true)
    {
        return $query->orderBy('position', $ascending ? 'asc' : 'desc');
    }

    public function category()
    {
        return $this->belongsTo('App\Category');
    }

}
