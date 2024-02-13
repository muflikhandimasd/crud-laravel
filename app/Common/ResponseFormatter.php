<?php

namespace App\Common;

use Illuminate\Http\Response;

class ResponseFormatter
{
    public static function success($data, $message = "Success")
    {
        return response()->json([
            'code' => Response::HTTP_OK,
            'data' => $data,
            'message' => $message,
        ], Response::HTTP_OK);
    }

    public static function error($code = 400, $message= null)
    {
        return response()->json([
            'code' => $code,
            'data' => null,
            'message' => $message,
        ], $code);
    }
}

