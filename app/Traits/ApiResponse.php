<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Resources\Json\JsonResource;

trait ApiResponse
{

    public function message(string $message = '',  int $status = 200, array|Model|JsonResource $data = [])
    {
        return response()->json([
            'success' => true,
            'message' => $message,
            'data' => $data
        ], $status);
    }

    public function errors(string $message = '', int $status = 400, array|string $erros)
    {
        return response()->json([
            'success' => false,
            'message' => $message,
            'erros' => $erros
        ], $status);
    }

    public function unathorized(string $message, $code = 401)
    {
        return response()->json([
            'success' => false,
            'message' => $message,
        ], $code);
    }


    public function response(string $message, int $code)
    {
        return response()->json([
            'message' => $message,
            'status' => $code
        ], $code);
    }
}
