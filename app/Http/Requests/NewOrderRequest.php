<?php

namespace App\Http\Requests;

use App\Coupon;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class NewOrderRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'billing.name' => 'required',
            'billing.email' => 'required|email',
            'billing.mobile' => 'required|min:10',
            'billing.region' => 'required',
            'billing.city' => 'required',
            'billing.address_line_one' => 'required',
            'billing.address_line_two' => 'nullable',

            'order.notes' => 'nullable',
            'order.payment_method' => 'required|in:cod,paypal',
        ];
    }

    public function messages()
    {
        return [
            'order.payment_method.in' => 'The selected payment method is invalid.'
        ];
    }

    public function persistOrder()
    {
        $orderData = $this->order;
        $orderData['total_price'] = Cart::total(0, '', '');
        $orderData['tax_percent'] = 0;
        // $orderData['discount_amount'] = 0;
        $orderData['shipping_charge'] = shippingCharge();
        $orderData['status'] = 'pending';
        $orderData['payment_status'] = 'pending';
        $order = Auth::user()->orders()->create($orderData);
        if($this->filled('coupon')){
            $order->applyCoupon($this->coupon);
            $order->save();
        }
        
        $order->address()->create($this->billing);
       
        return $order;
    }
}
