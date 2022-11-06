<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Utils\ResponseUtil;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Response;

class ApiBaseController extends Controller
{
    /**
     * @param        $data
     * @param string $message
     * @param int    $status
     *
     * @return JsonResponse
     */
    public function sendResponse($data, string $message, int $status = 200): JsonResponse
    {
        if (!is_array($data)) {
            $data = $data->toArray();
        }

        return Response::json(ResponseUtil::makeResponse($message, $data), $status);
    }

    /**
     * @param string $message
     * @param int    $status
     *
     * @return JsonResponse
     */
    public function sendError(string $message, int $status = 500): JsonResponse
    {
        return Response::json(ResponseUtil::makeError($message), $status ?: 500);
    }
}
