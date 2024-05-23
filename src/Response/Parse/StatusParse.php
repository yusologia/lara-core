<?php

namespace Logia\Core\Response\Parse;

class StatusParse
{
    /**
     * @var int|string
     */
    public int|string $code;

    /**
     * @var string
     */
    public string $message;

    /**
     * @var string|null
     */
    public string|null $internalMsg;

    /**
     * @var array|null
     */
    public array|null $attributes;

}
