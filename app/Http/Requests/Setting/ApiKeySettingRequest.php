<?php

namespace App\Http\Requests\Setting;

use Illuminate\Foundation\Http\FormRequest;

class ApiKeySettingRequest extends FormRequest
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
            'facebook_app_id' => 'required',
            'facebook_app_secret' => 'nullable',

            'google_client_id' => 'nullable', 
            'google_client_secret' => 'nullable', 

            'recaptcha_api_site_key' => 'nullable',
            'recaptcha_api_secret_key' => 'nullable',

            'facebook_chat_plugin' => 'nullable', 

            'header_scripts' => 'nullable', 
            'footer_scripts' => 'nullable', 
        ];
    }
}
