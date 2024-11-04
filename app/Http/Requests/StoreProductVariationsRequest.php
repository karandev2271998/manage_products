<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductVariationsRequest extends FormRequest
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
            'product_id' => 'required',
            'color' => 'required',
            'prize' => 'required',
            'size' => 'required',
            'stock_quantity' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'product_id.required' => 'Product id is required',
            'color.required' => 'Product color is required',
            'prize.required' => 'Product prize is required',
            'size.required' => 'Product size is required',
            'stock_quantity.required' => 'Product stock quantity is required',
        ];
    }
}
