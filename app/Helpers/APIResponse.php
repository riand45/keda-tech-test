<?php

namespace App\Helpers;

use Illuminate\Auth\AuthenticationException;
use Illuminate\Validation\ValidationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpKernel\Exception\HttpException;

class APIResponse
{

    public static function success($data)
    {
        return response()->json([
            'status' => 'success',
            'code' => 200,
            'data' => $data
        ], 200);
    }

    public static function error($exception)
    {
        $code = 500;
        $data = $exception->getMessage();
        if ($exception instanceof ValidationException) {
            $code = $exception->status;
            $data = $exception->errors();
        }
        if ($exception instanceof ModelNotFoundException) {
            $code = 404;
            $data = "Data not found";
        }
        if($exception instanceof HttpException){
            $code = $exception->getStatusCode();
            $data = $exception->getMessage();
        }

        if($exception instanceof AuthenticationException){
            $code = 401;
            $data = $exception->getMessage();
        }

        return response()->json([
            'status' => 'error',
            'code' => $code,
            'data' => $data
        ], $code);
    }
}
