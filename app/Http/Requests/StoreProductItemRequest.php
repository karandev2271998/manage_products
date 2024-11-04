<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductItemRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string',
            'description' => 'required|string',
            'price' => 'required',
            'stock_quantity' => 'required',
            'media' => 'required|array',
            'media.*' => 'mimes:jpg,jpeg,png,gif,mp4|max:20480',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Product name is required',
            'description.required' => 'Product description is required',
            'price.required' => 'Product price is required',
            'stock_quantity.required' => 'Product stock quantity is requred',
            'media.required' => 'At least one image or video is required',
            'media.*.mimes' => 'Each file must be a type of: jpg, jpeg, png, gif or mp4',
            'media.*.max' => 'Each file size must not exceed 20MB',
        ];
    }
}
