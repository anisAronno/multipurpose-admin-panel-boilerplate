<?php

namespace App\Http\Requests\User;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;

class UserUpdateRequest extends FormRequest
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
            'name' => 'required|string|max:250|min:3',
            'gender' => 'nullable|string|max:50|min:3',
            'email' => 'email:rfc,dns|max:255|unique:users,email,'.optional($this->user)->id,
            'avatar' => 'nullable|image|mimes:jpeg,jpg,png,gif,svg,webp|max:2048',
            'roles' => 'required|array|present|min:0',
            'status' => 'required|string',
        ];
    }
}
