<?php

namespace App\Http\Requests\Setting;

use Illuminate\Foundation\Http\FormRequest;

class PaymentSettingRequest extends FormRequest
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
            'paypal_enable_test_mode' => 'nullable',
            'paypal_client_id' => 'nullable',
            'paypal_api_secret' => 'nullable',
            'paypal_currency' => 'nullable'
        ];
    }
}
