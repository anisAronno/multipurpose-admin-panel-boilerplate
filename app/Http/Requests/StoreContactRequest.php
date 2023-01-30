<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreContactRequest extends FormRequest
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
            'first_name' => 'required|string|max:250|min:3',
            'last_name' => 'nullable|string|max:250|min:3',
            'email' => 'email:rfc,dns|max:255',
            'phone' => 'nullable|string|max:20',
            'subject' => 'required|min:0|max:255',
            'message' => 'required|string|max:500|min:0',
        ];
    }
}
