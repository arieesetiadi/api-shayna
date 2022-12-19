<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ResponseFormatterController extends Controller
{
    protected static $response = [
        'meta' => [
            'code' => 200,
            'status' => 'success',
            'message' => null
        ],
        'data' => null
    ];

    public static function success($data = null, $message = null)
    {
        self::$response['meta']['message'] = $message;
        self::$response['data'] = $data;

        return response()->json(self::$response, self::$response['meta']['code']);
    }

    public static function error($data = null, $message = null, $code = 4000)
    {
        self::$response['meta']['code'] = $code;
        self::$response['meta']['status'] = 'error';
        self::$response['meta']['message'] = $message;
        self::$response['data'] = $data;

        return response()->json(self::$response, self::$response['meta']['code']);
    }
}
