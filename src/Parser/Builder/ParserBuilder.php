<?php

namespace Logia\Core\Parser\Builder;

use Logia\Core\Parser\BaseParser;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class ParserBuilder
{
    public $arguments;

    private $parserClass;
    private $method;


    /**
     * @param $data
     * @param ...$arguments
     */
    public function __construct(public $data, ...$arguments)
    {
        $this->arguments = $arguments;
    }


    /**
     * @return $this
     */
    public function setParserClass()
    {
        if ($this->data) {

            $data = $this->data;

            if ($data instanceof LengthAwarePaginator) {
                $data = collect($data->items())->first();
            }

            if ($data instanceof Collection) {
                $data = $data->first();
            }

            $this->parserClass = $data?->parserClass ?: BaseParser::class;

        }

        return $this;
    }

    /**
     * @return mixed
     */
    public function getParserClass()
    {
        if (!$this->parserClass) {
            $this->setParserClass();
        }

        return $this->parserClass;
    }


    /**
     * @param $method
     *
     * @return $this
     */
    public function setMethod($method = null)
    {
        if ($method) {
            $this->method = $method;
        }

        if (!$this->data) {
            $this->method = "first";
        }

        if (!$this->method) {

            if (($this->data instanceof LengthAwarePaginator) || ($this->data instanceof Collection)) {
                $this->method = "get";
            }

            if ($this->data instanceof Model) {
                $this->method = "first";
            }

        }

        return $this;
    }

    /**
     * @return mixed
     */
    public function getMethod()
    {
        if (!$this->method) {
            $this->setMethod();
        }

        return $this->method;
    }

}
