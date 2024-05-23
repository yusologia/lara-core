<?php

namespace Logia\Core\Validation\Support;

use Logia\Core\Exception\ValidationException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest as FormRequestIlluminate;

class FormRequest extends FormRequestIlluminate
{
    /**
     * @param Validator $validator
     *
     * @throws ValidationException
     */
    protected function failedValidation(Validator $validator)
    {
        throw new ValidationException($validator);
    }

}
