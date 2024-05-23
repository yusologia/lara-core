<?php

namespace Logia\Core\Response\Contract;

use Logia\Core\Response\Parse\ResponseParse as ResponseParse;
use Illuminate\Http\JsonResponse;

interface ResponseBuilder
{
    /**
     * @param Status|null $status
     *
     * @return void
     */
    public function setStatus(Status|null $status = null);

    /**
     * @param $data
     *
     * @return void
     */
    public function setData($data);

    /**
     * @param $data
     *
     * @return array|void
     */
    public function setPagination($data);

    /**
     * @return void
     */
    public function isDataObject();

    /**
     * @param ResponseBuilder $builder
     *
     * @return ResponseParse|JsonResponse|mixed
     */
    public function parseToResponse(ResponseBuilder $builder);

}
