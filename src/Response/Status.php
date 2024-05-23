<?php

namespace Logia\Core\Response;

use Logia\Core\Response\Parse\StatusParse;

class Status implements Contract\Status
{
    /**
     * @var StatusParse
     */
    public StatusParse $parse;


    /**
     * @param int $httpStatus
     * @param string $message
     * @param string|null $internalMsg
     * @param object|array|null $attributes
     */
    public function __construct(public int               $httpStatus = 200,
                                public string            $message = 'Success',
                                public string|null       $internalMsg = null,
                                public object|array|null $attributes = null)
    {
        if (!$this->message) {
            $this->setDefaultMessage();
        }

        $this->parse = new StatusParse();
    }


    /**
     * @return void
     */
    public function setDefaultMessage()
    {
        $this->message = $this->httpStatus == 200 ? 'Success' : 'An error occurred';
    }

    /**
     * @param string $internalMsg
     *
     * @return void
     */
    public function setInternalMessage(string $internalMsg = '')
    {
        $this->internalMsg = $internalMsg;
    }

    /**
     * @param array|null $attributes
     *
     * @return void
     */
    public function setAttributes(array|null $attributes = [])
    {
        $this->attributes = $attributes;
    }

    /**
     * @return StatusParse
     */
    public function result()
    {
        $this->parse->code = $this->httpStatus;
        $this->parse->message = $this->message;
        $this->parse->internalMsg = $this->internalMsg;
        $this->parse->attributes = $this->attributes;

        return $this->parse;
    }

}
