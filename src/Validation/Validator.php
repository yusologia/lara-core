<?php

namespace Logia\Core\Validation;

use Logia\Core\Exception\ValidationException;
use Logia\Core\Response\Response;
use Logia\Core\Validation\Support\FormRequest;
use Illuminate\Support\Facades\Validator as ValidatorFacade;

class Validator extends FormRequest
{
    /**
     * @param array $data
     * @param array $rules
     *
     * @return mixed
     * @throws ValidationException
     */
    public static function make(array $data, array $rules)
    {
        $validator = ValidatorFacade::make($data, $rules);
        if ($validator->fails()) {
            throw new ValidationException($validator);
        }

        return Response::object();
    }
}
