<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'title' => 'required|string|max:250|min:3',
            'description' => 'nullable|string|max:2000|min:3', 
            'status' => 'required|string',
            'is_featured' => 'required|boolean',
            'is_commentable' => 'required|boolean',
            'is_reactable' => 'required|boolean',
            'is_ratingable' => 'required|boolean',
            'categories' => 'required|array|present|min:0',
        ];
    }
}
