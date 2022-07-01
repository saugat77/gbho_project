<?php

namespace App\Http\Requests\Setting;

use Illuminate\Foundation\Http\FormRequest;

class GeneralSettingRequest extends FormRequest
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
            'site_name' => 'required',
            'tagline' => 'nullable',
            'site_logo' => 'nullable',
            'favicon' => 'nullable',

            'show_top_bar' => 'nullable',
            'topbar_mobile' => 'nullable',
            'topbar_email' => 'nullable',

            'price_unit' => 'nullable',
            'shipping_charge' => 'nullable',
            // 'tax_percent' => 'nullable',
            'low_stock_threshold' => 'nullable',
            
            'show_bottom_bar' => 'nullable',
            'footer_left_text' => 'nullable',
            'footer_right_text' => 'nullable',

            'register_enable_captcha' => 'nullable'
        ];
    }
}
