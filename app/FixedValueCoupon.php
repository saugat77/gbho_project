<?php

namespace App;

use App\Contracts\Couponable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FixedValueCoupon extends Model implements Couponable
{
    use HasFactory;

    protected $guarded = [];

    public function discount($amount)
    {
        return $this->value;
    }

    public function type()
    {
        return Coupon::FIXED;
    }

    public function coupon()
    {
        return $this->morphMany('App\Coupon', 'couponable');
    }
}
