<?php

use Logia\Core\Response\Response;
use Logia\Core\Response\Status;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

if (!function_exists("success")) {

    /**
     * @param $data
     * @param string|null $message
     * @param string|null $internalMsg
     * @param array|null $attributes
     * @param bool $isObject
     * @param array|null $pagination
     *
     * @return \Illuminate\Http\JsonResponse|mixed
     */
    function success($data = null, string|null $message = 'Success', string|null $internalMsg = null, array|null $attributes = null, bool $isObject = false, array|null $pagination = null)
    {
        $status = new Status(200, $message, $internalMsg, $attributes);

        $method = $isObject ? "object" : "json";
        return Response::$method($status, $data, $pagination);
    }

}

if (!function_exists("error")) {

    /**
     * @param int $httpStatus
     * @param string $message
     * @param string|null $internalMsg
     * @param array|null $attributes
     *
     * @return \Illuminate\Http\JsonResponse|mixed
     * @throws \Logia\Core\Exception\ErrorException
     */
    function error(int $httpStatus = 500, string $message = 'An error occurred!', string|null $internalMsg = null, array|null $attributes = null)
    {
        throw new \Logia\Core\Exception\ErrorException($httpStatus, $message, $internalMsg, $attributes);
    }

}

if (!function_exists("exception")) {

    /**
     * @param $exception
     *
     * @return mixed
     * @throws \Logia\Core\Exception\ErrorException
     */
    function exception($exception)
    {
        if (!($exception instanceof \Exception)) {
            throw new \Logia\Core\Exception\ErrorException(500, "Internal server error!", $exception->getMessage());
        }

        throw $exception;
    }

}

if (!function_exists("pagination")) {

    /**
     * @param $data
     *
     * @return array|null
     */
    function pagination($data)
    {
        if ($data instanceof LengthAwarePaginator) {
            $totalPage = $data->lastPage();
            $currentPage = $data->currentPage();

            $next = $currentPage;
            if ($currentPage < $totalPage) {
                $next++;
            }

            $prev = $currentPage;
            if ($currentPage > 1) {
                $prev--;
            }

            return [
                'count' => $data->count(),
                'total' => $data->total(),
                'currentPage' => $currentPage,
                'perPage' => $data->perPage(),
                'totalPage' => $totalPage,
                'links' => [
                    'next' => $next,
                    'previous' => $prev
                ],
            ];
        }

        return null;
    }

}
