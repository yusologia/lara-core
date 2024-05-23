<?php

namespace Logia\Core\Response\Builder;

use Logia\Core\Parser\Parser;
use Logia\Core\Response\Contract\ResponseBuilder as ResponseBuilderContract;
use Logia\Core\Response\Contract\Status;
use Logia\Core\Response\Parse\ResponseParse;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\JsonResponse;

class ResponseBuilder implements ResponseBuilderContract
{
    /**
     * @var ResponseParse
     */
    public ResponseParse $parse;

    /**
     * @var bool
     */
    public bool $isObject = false;


    public function __construct()
    {
        $this->parse = new ResponseParse();
    }


    /**
     * @param Status|null $status
     *
     * @return void
     */
    public function setStatus(Status|null $status = null)
    {
        if (!$status) {
            $status = new \Logia\Core\Response\Status();
        }

        if ($status) {
            $this->parse->status = $status->result();
        }
    }

    /**
     * @param $data
     *
     * @return void
     */
    public function setData($data)
    {
        if ($data instanceof LengthAwarePaginator) {
            $this->setPagination($data);
        }

        $this->parse->result = is_array($data) ? $data : Parser::response($data);
    }

    /**
     * @param $data
     *
     * @return array|void
     */
    public function setPagination($data)
    {
        if (!$data) {
            return;
        }

        if (is_array($data) && array_key_exists('totalPage', $data)) {
            $this->parse->pagination = $data;
            return;
        }

        if (!($data instanceof LengthAwarePaginator)) {
            return;
        }

        if ($this->parse->pagination) {
            return;
        }

        $this->parse->pagination = pagination($data);
    }

    /**
     * @return void
     */
    public function isDataObject()
    {
        $this->isObject = true;
    }

    /**
     * @param ResponseBuilderContract $builder
     *
     * @return ResponseParse|JsonResponse|mixed
     */
    public function parseToResponse(ResponseBuilderContract $builder)
    {
        $parse = $builder->parse;
        if (!$builder->isObject) {
            return response()->json($parse, $parse->status->code);
        }

        return $parse;
    }

}
