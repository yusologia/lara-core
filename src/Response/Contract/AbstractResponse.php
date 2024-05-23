<?php

namespace Logia\Core\Response\Contract;

interface AbstractResponse
{
    /**
     * @param Status $status
     * @param $data
     * @param $pagination
     *
     * @return mixed
     */
    public static function json(Status $status, $data = null, $pagination = null);

    /**
     * @param Status $status
     * @param $data
     * @param $pagination
     *
     * @return mixed
     */
    public static function object(Status $status, $data = null, $pagination = null);

}
