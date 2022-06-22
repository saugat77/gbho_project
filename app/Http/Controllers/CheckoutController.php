<?php

namespace App\Http\Controllers;

use App\Coupon;
use App\OrderAddress;
use App\User;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = User::with('address')->find(Auth::id());
        synCartPrice(); // Helper method
        $shippingCharge = shippingCharge();
        $discount = session()->get('coupon')['discount'] ?? 0;
        $total = (Cart::total(0, '', '')) + $shippingCharge - $discount;

        return view('frontend.checkout.index', [
            'user' => $user,
            'cartProducts' => Cart::content(),
            'discount' => 0,
            'shippingCharge' => $shippingCharge,
            'total' => $total,
            'lastShippingAddress' => $user->orders()->first()->address ?? new OrderAddress(),
        ]);
    }

    public function applyCoupon(Request $request)
    {
        $request->validate([
            'code' => 'required'
        ]);

        $coupon = Coupon::findByCode($request->code);

        if (!$coupon || !$coupon->isValid()) {
            return back()->with('error', 'Invalid coupon code.');
        }

        session()->put('coupon', [
            'code' => $coupon->code,
            'discount' =>  $coupon->discount((Cart::total(0, '', '')))
        ]);

        return back()->with('success', 'Coupon code has been applied.');
    }
}
