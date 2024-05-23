<?php

namespace Logia\Core\Exception;

use Logia\Core\Response\Response;
use Logia\Core\Response\Status;
use Exception;
use Illuminate\Contracts\Validation\Validator;

class ValidationException extends Exception
{

    /**
     * @param \Illuminate\Support\Facades\Validator|Validator $validator
     * @param bool $isObject
     */
    public function __construct(public \Illuminate\Support\Facades\Validator|Validator $validator,
                                public bool                                            $isObject = false)
    {
        parent::__construct();
    }


    /**
     * @return \Illuminate\Http\JsonResponse|object
     */
    public function render()
    {
        $messages = $this->validator->errors()->messages();

        $attributes = [];
        foreach ($messages as $key => $error) {
            $attributes[] = [
                'param' => $key,
                'msg' => current($error)
            ];
        }

        $error = new Status(400, "Missing required parameter");
        $error->setAttributes($attributes);

        $response = $this->isObject ? "object" : "json";

        return Response::$response($error);
    }

}
