<?php

namespace App\Http\Livewire;

use App\Coupon;
use App\FixedValueCoupon;
use App\PercentOffCoupon;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class CouponForm extends Component
{
    public $coupon;

    public $code;
    public $start_date;
    public $end_date;
    public $type;
    public $fixed_amount;
    public $percent_off_amount;

    public $updateMode = false;
    public $errorMessage = null;

    protected function rules()
    {
        return [
            'code' => ['required', 'unique:coupons,code,' . $this->coupon->id ?? 'null'],
            'start_date'  => ['required', 'date'],
            'end_date' => ['required', 'date', 'after:start_date'],
            'type' => ['required'],
            'fixed_amount' => ['required_if:type,fixed'],
            'percent_off_amount' => ['required_if:type,percent'],
        ];
    }

    public function mount(Coupon $coupon)
    {
        $this->coupon = $coupon;
        if ($coupon->exists) {
            $this->updateMode = true;
            $this->code = $coupon->code;
            $this->start_date = $coupon->start_date->format('Y-m-d');
            $this->end_date = $coupon->end_date->format('Y-m-d');
            $this->code = $coupon->code;
            $this->type = $coupon->getType();

            if ($this->type == Coupon::FIXED) {
                $this->fixed_amount =  $coupon->couponable->value;
            }
            if ($this->type == Coupon::PERCENT_OFF) {
                $this->percent_off_amount =  $coupon->couponable->percent_off;
            }
        }
    }

    public function submit()
    {
        $this->errorMessage = null;
        $this->validate();

        if ($this->updateMode) {
            return $this->update();
        }

        return $this->create();
    }

    public function create()
    {
        try {
            DB::beginTransaction();

            if ($this->type == Coupon::FIXED) {
                $couponable = FixedValueCoupon::create([
                    'value' => $this->fixed_amount
                ]);
            }

            if ($this->type == Coupon::PERCENT_OFF) {
                $couponable = PercentOffCoupon::create([
                    'percent_off' => $this->percent_off_amount
                ]);
            }

            $couponable->coupon()->save(new Coupon([
                'code' => $this->code,
                'start_date' => $this->start_date,
                'end_date' => $this->end_date
            ]));
            DB::commit();

            return redirect()->route('coupons.index')->with('success', 'Coupon added successfully.');
        } catch (\Throwable $th) {
            DB::rollBack();
            report($th);
            $this->errorMessage = 'Something went wrong while creating coupon.';
        }
    }

    public function update()
    {
        try {
            DB::beginTransaction();

            $this->coupon->update([
                'code' => $this->code,
                'start_date' => $this->start_date,
                'end_date' => $this->end_date
            ]);

            if ($this->type == Coupon::FIXED) {
                $this->coupon->couponable->update([
                    'value' => $this->fixed_amount
                ]);
            }

            if ($this->type == Coupon::PERCENT_OFF) {
                $this->coupon->couponable->update([
                    'percent_off' => $this->percent_off_amount
                ]);
            }
            DB::commit();
            return redirect()->route('coupons.index')->with('success', 'Coupon updated successfully.');
        } catch (\Throwable $th) {
            DB::rollBack();
            report($th);
            $this->errorMessage = 'Something went wrong while updating coupon.';
        }
    }

    public function render()
    {
        return view('livewire.coupon-form');
    }
}
