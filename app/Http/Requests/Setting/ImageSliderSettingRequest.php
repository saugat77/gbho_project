<?php

namespace App\Http\Requests\Setting;

use Illuminate\Foundation\Http\FormRequest;

class ImageSliderSettingRequest extends FormRequest
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
            'primary_image_slider_height_desktop' => 'nullable|integer',
            'primary_image_slider_height_mobile' => 'nullable|integer',
            'primary_image_slider_autoplay_speed' => 'nullable|integer',
            'primary_image_slider_autoplay_delay' => 'nullable|integer',
            'primary_image_slider_show_navigation' => 'nullable',
            'primary_image_slider_show_pagination' => 'nullable',
        ];
    }
}
