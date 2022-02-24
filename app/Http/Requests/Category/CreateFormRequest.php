<?php

namespace App\Http\Requests\Category;

use Illuminate\Foundation\Http\FormRequest;

class CreateFormRequest extends FormRequest
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
            'category_name' => 'required|max:255',
            'category_desc' => 'required|max:255',
        ];
    }

    public function messages(){
        return [
            'category_name.required' => 'Không Được để Trống Tên Danh Mục',
            'category_desc.required' => 'Không Được để Trống Mô Tả Danh Mục'
        ];
    }
}
