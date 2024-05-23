<?php

namespace Logia\Core\Response\Parse;

class ResponseParse
{
    /**
     * @var StatusParse|null
     */
    public StatusParse|null $status = null;

    /**
     * @var array|object|null
     */
    public array|object|null $result = null;

    /**
     * @var array|null
     */
    public array|null $pagination = null;

}
