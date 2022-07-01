<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderProduct extends Model
{
    protected $guarded = [];
    public $timestamps = false;

    public function getPriceTotalAttribute()
    {
        return ((int)$this->price) * ((int)$this->quantity ?? 1);
    }

    public function package()
    {
        return $this->belongsTo('App\Package');
    }

    public function product()
    {
        return $this->belongsTo('App\Product');
    }
}
