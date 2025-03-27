<?php

namespace App\Classes;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ApiResponse
{
    public static function rollback(
        $e,
        $message = "Something went wrong! Process not completed."
    ): void
    {
        DB::rollback();
        self::throw($e, $message);
    }

    public static function throw(
        $e,
        $message = "Something went wrong! Process not completed."
    ): void
    {
        Log::error($e);
        throw new \HttpResponseException(
            response()->json(['message' => $message], 500)
        );
    }

    public static function sendResponse($result, $message, $success = true, $code = 200): JsonResponse
    {
        // Need to respond FALSE when an action is not completed
        $response = [
            'success' => $success,
            'message' => $message ?? null,
            'data' => $result,
        ];

        return response()->json($response, $code);
    }

    public static function success($result, $message, $code = 200): JsonResponse
    {
        return self::sendResponse($result, $message, true, $code);
    }

    public static function error($result, $message, $code = 500): JsonResponse
    {
        return self::sendResponse($result, $message, false, $code);
    }

}
