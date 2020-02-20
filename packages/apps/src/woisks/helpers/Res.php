<?php

declare(strict_types=1);

/*
 * +----------------------------------------------------------------------+
 * |                   At all timesI love the moment                      |
 * +----------------------------------------------------------------------+
 * | Copyright (c) 2019 www.Woisk.com All rights reserved.                |
 * +----------------------------------------------------------------------+
 * |  Author:  Maple Forest  <Woisks@126.com>   QQ:364956690   286013629  |
 * +----------------------------------------------------------------------+
 */

use Carbon\Carbon;
use Illuminate\Http\JsonResponse;

if (!function_exists('res')) {


    /**
     * res 2019/5/10 12:09
     *
     * @param  string  $code
     * @param  string  $message
     * @param  null  $data
     *
     * @return JsonResponse
     */
    function res(string $code, string $message, $data = null): JsonResponse
    {
        $timestamp = Carbon::now()->timestamp;
        if (empty($data)) {
            return response()->json([
                'code'       => $code,
                'message'    => $message,
                'request_id' => $timestamp
            ])->setStatusCode(200);
        }

        $nonce = random_string(8);
        $key   = md5($timestamp.$nonce);

        return response()->json([
            'code'       => $code,
            'message'    => $message,
            'request_id' => $timestamp,
            'data'       => $data,
            'key'        => $key,
            'nonce'      => $nonce
        ])->setStatusCode(200);

    }
}