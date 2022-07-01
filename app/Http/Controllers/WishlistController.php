<?php

namespace App\Http\Controllers;

use App\Wishlist;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    public function index()
    {
        $wishlists = Wishlist::with('product')->where('user_id', Auth::user()->id)->get();
        $heading = 'My Wishlist';

        return view('frontend.wishlist.index', compact([
            'wishlists',
            'heading'
        ]));
    }

    public function destroy(Wishlist $wishlist)
    {
        $wishlist->delete();

        return redirect()->back()->with('defaultAlert', 'Removed from wishlist');
    }
}
