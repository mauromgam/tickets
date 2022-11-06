<?php

namespace App\Utils;

use JetBrains\PhpStorm\ArrayShape;

class ResponseUtil
{
    const RESPONSE_ARRAY_SHAPE = [
        'success' => "bool",
        'message' => "string",
        'data'    => "array",
    ];

    /**
     * @param string $message
     * @param mixed  $data
     *
     * @return array
     */
    #[ArrayShape(self::RESPONSE_ARRAY_SHAPE)]
    public static function makeResponse(string $message, array $data): array
    {
        return self::response(true, $message, $data);
    }

    /**
     * @param string $message
     *
     * @return array
     */
    #[ArrayShape(self::RESPONSE_ARRAY_SHAPE)]
    public static function makeError(string $message): array
    {
        return self::response(false, $message);
    }

    /**
     * @param bool   $success
     * @param string $message
     * @param array  $data
     *
     * @return array
     */
    #[ArrayShape(self::RESPONSE_ARRAY_SHAPE)]
    public static function response(bool $success, string $message, array $data = []): array
    {
        $response = [
            'success' => $success,
            'message' => $message,
        ];

        if (!empty($data)) {
            $response['data'] = $data;
        } elseif ($success) {
            $response['data'] = [];
        }

        return $response;
    }
}
