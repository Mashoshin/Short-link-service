<?php

namespace src\Domain\helpers;

use Throwable;

class ResponseHelper
{
    const STATUS_RESPONSE_OK = "OK";
    const STATUS_RESPONSE_ERROR = "ERROR";

    const ERROR_TYPE_SERVER = "SERVER";

    /**
     * @param array $data
     * @return string
     */
    public static function getOk(array $data): string
    {
        return json_encode([
            'status' => self::STATUS_RESPONSE_OK,
            'data' => $data,
        ], JSON_UNESCAPED_SLASHES);
    }

    /**
     * @param Throwable $exception
     * @return string
     * @throws
     */
    public static function getServerError(Throwable $exception): string
    {
        $message = $exception->getMessage();
        return json_encode([
            'status' => self::STATUS_RESPONSE_ERROR,
            'error_type' => $exception->getCode() ?: self::ERROR_TYPE_SERVER,
            'errors' => [
                ['message' => $message]
            ],
        ], JSON_UNESCAPED_SLASHES);
    }
}