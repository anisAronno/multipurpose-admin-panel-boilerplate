<?php

namespace App\Http\Requests\User;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserStoreRequest extends FormRequest
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
            'name'                  => 'required|string|max:250|min:3',
            'email'                 => 'email:rfc,dns|max:255|unique:users,email',
            'avatar'                => 'nullable|image|mimes:jpeg,jpg,png,gif,svg|max:2048',
            'roles'                 => "required|array|present|min:0",
            'status'                => 'required|string',
            'password'              => 'required| min:8| max:32 |confirmed',
            'password_confirmation' => 'required| min:8',
        ];
    }
}
