<?php

namespace App\Rules\Options;

use AnisAronno\MediaHelper\Facades\Media;
use Illuminate\Contracts\Validation\Rule;

class OptoinValueFilterRule implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        if (is_file($value)) {
            return (bool) Media::isAllowedFileType($value->getClientOriginalName());
        } else {
            return true;
        }
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The file type is not exceptable.';
    }
}
