<?php

namespace Logia\Core\Response;

use Logia\Core\Response\Contract\ResponseBuilder;
use Logia\Core\Response\Parse\ResponseParse;
use Illuminate\Http\JsonResponse;

class Response extends AbstractResponse
{
    /**
     * @param ResponseBuilder $builder
     *
     * @return ResponseParse|JsonResponse|mixed
     */
    public function handle(ResponseBuilder $builder)
    {
        return $builder->parseToResponse($builder);
    }

}
