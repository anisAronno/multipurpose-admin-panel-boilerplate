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
            'description' => 'nullable|string|max:5000|min:3',
            'short_description' => 'nullable|string|max:500|min:3',
            'status' => 'nullable|string',
            'type' => 'nullable|string',
            'is_premium' => 'nullable|boolean',
            'is_featured' => 'nullable|boolean',
            'is_commentable' => 'nullable|boolean',
            'is_reactable' => 'nullable|boolean', 
            'is_shareable' => 'nullable|boolean',
            'show_ratings' => 'nullable|boolean',
            'show_views' => 'nullable|boolean',
        ];
    }
}
