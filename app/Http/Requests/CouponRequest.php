<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CouponRequest extends FormRequest
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
            'type' => [
                'required',
                Rule::in([\App\Coupon::FIXED, \App\Coupon::PERCENT_OFF,  \App\Coupon::MINIMUM_QUANTITY])
            ],

            'coupon.code' => ['required', 'unique:coupons,code'],
            'coupon.start_date' => ['nullable', 'date'],
            'coupon.end_date' => ['nullable', 'date'],

            \App\Coupon::FIXED . '.value' => [
                Rule::requiredIf($this->type == \App\Coupon::FIXED),
            ],

            \App\Coupon::PERCENT_OFF. '' => [
                Rule::requiredIf($this->type == \App\Coupon::PERCENT_OFF),
            ],

            \App\Coupon::MINIMUM_QUANTITY . '.product_id' => [
                Rule::requiredIf($this->type == \App\Coupon::MINIMUM_QUANTITY),
                'exists:products,id'
            ],
            \App\Coupon::MINIMUM_QUANTITY . '.minimun_quantity' => [
                Rule::requiredIf($this->type == \App\Coupon::MINIMUM_QUANTITY),
                'integer'
            ],
            \App\Coupon::MINIMUM_QUANTITY . '.percent_off' => [
                Rule::requiredIf($this->type == \App\Coupon::MINIMUM_QUANTITY),
                'number'
            ],

        ];
    }
}
