<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PurchasedProduct extends Model
{
    protected $fillable = ['user_id', 'product_id'];

    public function user()
    {
        return $this->hasOne('App\User');
    }

    public function product()
    {
        return $this->hasOne('App\Product');
    }
}
