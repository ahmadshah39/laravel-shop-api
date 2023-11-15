<?php

namespace App\Traits;


trait HttpResponse
{
    public function success($data, $message, $code = 200): \Illuminate\Http\JsonResponse
    {
        return response()->json([
            'status' => "Request was successfull",
            'message' => $message,
            'data' => $data
        ], 200);
    }

    public function error( $message, $code): \Illuminate\Http\JsonResponse
    {
        return response()->json([
            'status' => "Request was unsuccessfull",
            'message' => $message,
        ], $code);
    }
}
