<?php

namespace App\Traits\api\v1;

/**
 *
 */
trait HttpResponse
{
    protected function success($data, $message, $status_code = 200){
        return response()->json([
            'status_code' => $status_code,
            'message' => $message,
            'result' => $data
        ], $status_code);
    }

    protected function error($data, $message, $status_code){
        return response()->json([
            'status_code' => $status_code,
            'message' => $message,
            'result' => $data
        ], $status_code);
    }
}
