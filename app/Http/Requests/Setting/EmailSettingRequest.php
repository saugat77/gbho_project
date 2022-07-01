<?php

namespace App\Http\Requests\Setting;

use Illuminate\Foundation\Http\FormRequest;

class EmailSettingRequest extends FormRequest
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
            'mail_driver' => 'required',
            'mail_host' => 'nullable',
            'mail_port' => 'nullable',
            'mail_encryption' => 'nullable',
            'mail_username' => 'nullable',
            'mail_password' => 'nullable',
            'mail_from_address' => 'nullable',
            'mail_from_name' => 'nullable',
        ];
    }
}
