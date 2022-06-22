<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MinimumQuantityCoupon extends Model
{
    use HasFactory;
    
    protected $guarded = [];

    public function type()
    {
        return Coupon::MINIMUM_QUANTITY;
    }
}
