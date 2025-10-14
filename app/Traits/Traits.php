<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Resources\Json\JsonResource;

trait Traits {

    public function messageResponse(string $message = '',  int $status = 200, array|Model|JsonResource $data = [])
    {
        return response()->json([
            'sucess' => true,
            'message' => $message,
            'status' => $status,
            'data' => $data
        ]);
    }

    public function errorsMessage(array|string $erros, string $message = '', int $status = 400)
    {
        return response()->json([
            'success' => false,
            'message' => $message,
            'status' => $status,
            'erros' => $erros
        ], $status);
    }
}