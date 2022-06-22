<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    use HasFactory;

    public const FIXED = 'fixed';
    public const PERCENT_OFF = 'percent';
    public const MINIMUM_QUANTITY = 'minimun_quantity';

    protected $guarded = [];

    protected $dates = [
        'start_date',
        'end_date',
    ];

    public static function findByCode($code)
    {
        return self::where('code', $code)->first();
    }

    public function discount($billAmout)
    {
        return $this->couponable->discount($billAmout);
    }

    public function isValid()
    {
        return Carbon::now()->between($this->start_date, $this->end_date);
    }

    public function couponable()
    {
        return $this->morphTo();
    }

    public function getType()
    {
        if ($this->couponable_type == 'App\FixedValueCoupon') {
            return self::FIXED;
        }

        if ($this->couponable_type == 'App\PercentOffCoupon') {
            return self::PERCENT_OFF;
        }

        return null;
    }
}
