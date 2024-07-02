<?php

namespace App\Traits;


trait HttpResponse
{
    public function success($data, $message, $code = 200): \Illuminate\Http\JsonResponse
    {
        return response()->json([
            'success' => 1,
            'message' => $message,
            'data' => $data
        ], $code);
    }

    public function error( $message, $code): \Illuminate\Http\JsonResponse
    {
        return response()->json([
            'success' => 1,
            'message' => $message,
        ], $code);
    }
}
