<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCategoryRequest extends FormRequest
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
            'name' => 'required|min:2|max:255|unique:category.name'.($this->id ?? ""),
        ];
    }

    public function messages(){
        return [
            'required' => 'attribute cannot be empty',
            'min' => ':attribute must be between 2-255 characters',
            'max' => ':attribute must be between 2-255 characters',
            'unique' => ':attribute exist',
        ];

    }
    public function attributes(){
        return [
            'name' => 'Tên danh mục sản phẩm'
        ];
    }
}