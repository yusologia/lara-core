<?php

namespace Logia\Core\Parser\Contract;

interface AbstractParser
{
    /**
     * @param $data
     * @param ...$args
     *
     * @return mixed
     */
    public static function response($data, ...$args);
}
