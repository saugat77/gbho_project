<?php

namespace App\Http\Controllers\Backend;

use App\Coupon;
use App\FixedValueCoupon;
use App\Http\Controllers\Controller;
use App\Http\Requests\CouponRequest;
use App\MinimumQuantityCoupon;
use App\PercentOffCoupon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CouponController extends Controller
{
    public function index()
    {
        return view('coupon.index', [
            'coupons' => Coupon::with('couponable')->latest()->get()
        ]);
    }

    public function create()
    {
        return $this->showForm(new Coupon());
    }

    private function showForm(Coupon $coupon)
    {
        return view('coupon.form', compact('coupon'));
    }

    public function edit(Coupon $coupon)
    {
        return $this->showForm($coupon);
    }

    // TODO:: this method is no longer used
    // We are using livewire now
    public function store(CouponRequest $request)
    {
        try {
            DB::beginTransaction();
            $couponType = $request['type'];
            if ($couponType == \App\Coupon::FIXED) {
                $couponable = FixedValueCoupon::create($request->validated()[\App\Coupon::FIXED]);
            }

            if ($couponType == \App\Coupon::PERCENT_OFF) {
                $couponable = PercentOffCoupon::create($request->validated()[\App\Coupon::PERCENT_OFF]);
            }

            if ($couponType == \App\Coupon::MINIMUM_QUANTITY) {
                $couponable = MinimumQuantityCoupon::create($request->validated()[\App\Coupon::MINIMUM_QUANTITY]);
            }

            $couponable->coupon()->save(new Coupon($request->validated()['coupon']));

            DB::commit();

            return redirect()->route('coupons.index')->with('success', 'Coupon added successfully.');
        } catch (\Throwable $th) {
            DB::rollBack();
            report($th);
            return redirect()->back()->with('error', 'Something went wrong while saving coupon.');
        }
    }

    public function destroy(Coupon $coupon)
    {
        $coupon->couponable()->delete();
        $coupon->delete();

        return redirect()->route('coupons.index')->with('success', 'Coupon deleted successfully.');
    }
}
