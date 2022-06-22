<?php

namespace App\Traits;

use App\Wishlist;
use Illuminate\Support\Facades\Auth;

trait HasWishlist
{
    public function wishlists()
    {
        return $this->hasMany('App\Wishlist');
    }

    public function wishlisted()
    {
        if (!Auth::check()) {
            return false;
        }
        return Auth::user()->wishlists()->where('product_id', $this->id)->exists()
            ? true
            : false;
    }

    public function addToWishlist()
    {
        Wishlist::create([
            'user_id' => Auth::user()->id,
            'product_id' => $this->id
        ]);
    }

    public function removeFromWishlist()
    {
        Wishlist::where('user_id', Auth::user()->id)->where('product_id', $this->id)->delete();
    }
}
