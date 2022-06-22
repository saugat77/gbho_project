<?php

namespace App;

use App\Contracts\Couponable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PercentOffCoupon extends Model implements Couponable
{
    use HasFactory;

    protected $guarded = [];

    public function discount($amount)
    {
        return $amount * ($this->percent_off / 100);
    }

    public function type()
    {
        return Coupon::PERCENT_OFF;
    }

    public function coupon()
    {
        return $this->morphMany('App\Coupon', 'couponable');
    }
}
