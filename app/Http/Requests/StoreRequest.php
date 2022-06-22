<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
            'name' => 'required',
            'slug' => $this->isMethod('POST') ? 'nullable' : 'required',
            'contact' => 'nullable',
            'user_id' => 'required|exists:users,id',
            'status' => 'required|in:' . implode(',', array_keys(config('constants.store.status'))),
            'logo' => 'nullable|image',
            'cover_image' => 'nullable|image',
        ];
    }
}
