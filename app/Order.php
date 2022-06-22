<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;
use Sqits\UserStamps\Concerns\HasUserStamps;

class Order extends Model
{
    use SoftDeletes, HasUserStamps;

    // protected $keyType = 'string';
    // public $incrementing = false;
    protected $guarded = [];

    public static function booted()
    {
        static::addGlobalScope('viewable', function (Builder $builder) {
            if (auth()->user()->hasRole('customer')) {
                $builder->where('user_id', auth()->user()->id);
            }
        });
    }

    // use billAmount() instead ahead
    public function getPriceWithShippingAttribute()
    {
        return ((int)$this->total_price) + ((int)$this->shipping_charge);
    }

    // Get the final price customer should pay
    public function billAmount()
    {
        return (int)$this->total_price + (int)$this->shipping_charge - (int)$this->discount_amount;
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function address()
    {
        return $this->hasOne('App\OrderAddress', 'order_id');
    }

    public function products()
    {
        return $this->hasMany(OrderProduct::class, 'order_id');
    }
}
