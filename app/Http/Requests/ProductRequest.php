<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            'slug' => $this->isMethod('put') ? 'required' : 'nullable',
            'category_id' => 'required|exists:App\Category,id',
            'active' => 'nullable|boolean',
            'regular_price' => 'required',
            'sale_price' => 'nullable|numeric',
            'sale_price_from' => 'nullable|date|required_with:sale_price',
            'sale_price_to' => 'nullable|date|required_with:sale_price',
            'product_highlights' => 'nullable',
            'description' => 'required',
            'purchase_note' => 'nullable',
            'image' => $this->isMethod('put') ? 'nullable' : 'required',
            'sku' => 'nullable',
            'manage_stock' => 'nullable|boolean',
            'stock_quantity' => 'nullable|required_with:manage_stock|integer',
            'limited_stock' => 'nullable|boolean',
            'product_weight' => 'nullable|max:20',
            'product_length' => 'nullable',
            'product_width' => 'nullable',
            'product_height' => 'nullable',
        ];
    }
}
