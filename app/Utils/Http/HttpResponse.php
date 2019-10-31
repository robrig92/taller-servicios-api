<?php

namespace App\Utils\Http;

class HttpResponse 
{
    public static function notFound($data = [], $message = '') 
    {
        !empty($message) ? : $message = 'Not found';

        return response()->json(compact('message', 'data'), 404);
    }

    public static function ok($data = [], $message = '') 
    {
        !empty($message) ? : $message = 'Ok';

        return response()->json(compact('message', 'data'), 200);
    }

    public static function created($data = [], $message = '') 
    {
        !empty($message) ? : $message = 'Creado';

        return response()->json(compact('message', 'data'), 201);
    }

    public static function unauthorized($data = [], $message = '')
    {
        !empty($message) ?: $message = 'No autorizado';

        return response()->json(compact('message', 'data'), 401);
    }
}