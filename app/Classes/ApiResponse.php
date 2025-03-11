<?php

namespace App\Classes;

use App\DB;
use App\Log;

class ApiResponse
{
    public static function rollback(
        $e,
        $message = "Something went wrong! Process not completed."
    ) {
        DB::rollback();
        self::throw($e, $message);
    }

    public static function throw(
        $e,
        $message = "Something went wrong! Process not completed."
    ) {
        Log::error($e);
        throw new \HttpResponseException(
            response()->json(['message' => $message], 500)
        );
    }

    public static function sendResponse( $result, $message, $success=true, $code = 200)
    {
        // Need to respond FALSE when an action is not completed
        $response = [
            'success' => $success,
            'message' => $message ?? null,
            'data' => $result,
        ];

        return response()->json($response);
    }

    public static function success($result, $message,$code = 200)
    {
        $success=true;
        return self::sendResponse($result,$message,$success, $code);
    }

    public static function error($result, $message,  $code = 500)
    {
        $success = false;
        return self::sendResponse($result, $message,$success, $code);
    }

}
