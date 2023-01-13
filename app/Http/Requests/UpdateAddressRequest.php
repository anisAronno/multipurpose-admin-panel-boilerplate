<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAddressRequest extends FormRequest
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
            'title'   => ['required','string', 'max:255'],
            'address' =>['nullable', 'string', "max:999"],
            'city' =>['nullable', 'string', "max:250"],
            'state' =>['nullable', 'string', "max:250"],
            'district' =>['nullable', 'string', "max:250"],
            'zip_code' =>['nullable', 'string', "max:250"],
            'country' =>['nullable', 'string', "max:250"],
        ];
    }
}
