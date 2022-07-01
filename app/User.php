<?php

namespace App;

use Illuminate\Auth\Events\Registered;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;
    use HasRoles;
   

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
       'userid' ,'firstname','lastname','dob','parent_address','parent_apt','parent_city','parent_state',
       'parent_country','parent_zip','phone','email','spouse_first_name','spouse_last_name', 'child_first_name','child_last_name','child_age',
       'child_address','child_city','child_state','child_country','child_zip',
        'password', 'provider', 'provider_id', 'avatar', 'mobile', 'address',
        'gender', 'role'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'status' => 'boolean',
    ];

    // public function setPasswordAttribute($pass)
    // {
    //     $this->attributes['password'] = Hash::make($pass);
    // }

    /**
     * Returns the gravatar URL for current user
     *
     * @usage user()->gravatar
     */
    public function getGravatarAttribute()
    {
        $hash = md5(strtolower(trim($this->attributes['email'])));
        $uiAvatar = http_build_query([
            'd' => 'https://ui-avatars.com/api/' . $this->attributes['name'] . '/128&background=2e88e1&color=fff']);
        return "http://www.gravatar.com/avatar/$hash?s=260&d=mp&" . $uiAvatar;
    }

    public function hasPurchased(Product $product)
    {
        return $this->purchasedProducts()->where('product_id', $product->id)->count();
    }

    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }

    public function scopeInactive($query)
    {
        return $query->where('status', 0);
    }

    public function isActive()
    {
        return $this->status ? true : false;
    }

    public function address()
    {
        return $this->hasOne('App\Address')->withDefault();
    }

    public function store()
    {
        return $this->hasOne('App\Store');
    }

    public function orders()
    {
        return $this->hasMany('App\Order')->latest();
    }

    public function wishlists()
    {
        return $this->hasMany('App\Wishlist');
    }

    public function ratings()
    {
        return $this->hasMany('App\ProductRating');
    }

    public function purchasedProducts()
    {
        return $this->hasMany('App\PurchasedProduct');
    }
}
