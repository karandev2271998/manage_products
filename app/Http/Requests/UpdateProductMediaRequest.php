<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductMediaRequest extends FormRequest
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
            'product_media' => 'required|array',
            'product_media.*' => 'mimes:jpg,jpeg,png,gif,mp4|max:20480',
        ];
    }

    public function messages()
    {
        return [
            'product_id.required' => 'Product id is required',
            'product_media.required' => 'At least one image or video is required',
            'product_media.*.mimes' => 'Each file must be a type of: jpg, jpeg, png, gif or mp4',
            'product_media.*.max' => 'Each file size must not exceed 20MB',
        ];
    }
}
