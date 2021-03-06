<?php

namespace App\Http\Requests\Product;

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
            'product_name' => 'required|max:255',
            'thumb' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'product_name.required' => 'A product_name is required',
            'thumb.required' => 'A thumb is required',
        ];
    }
}
