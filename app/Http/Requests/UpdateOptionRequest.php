<?php

namespace App\Http\Requests;

use App\Rules\Options\OptoinKeyUniqueRule;
use App\Rules\Options\OptoinValueFilterRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateOptionRequest extends FormRequest
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
            'option_key' => ['nullable', 'string', 'max:255', new OptoinKeyUniqueRule],
            'option_value' => ['nullable', 'string', 'max:2000', new OptoinValueFilterRule],
        ];
    }
}
