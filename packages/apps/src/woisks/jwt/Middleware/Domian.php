<?php

declare(strict_types=1);

/*
 * +----------------------------------------------------------------------+
 * |                   At all timesI love the moment                      |
 * +----------------------------------------------------------------------+
 * | Copyright (c) 2019 www.Woisk.com All rights reserved.                |
 * +----------------------------------------------------------------------+
 * |  Author:  Maple Grove  <bolelin@126.com>   QQ:364956690   286013629  |
 * +----------------------------------------------------------------------+
 */

namespace Woisks\Jwt\Middleware;


use Closure;
use Illuminate\Http\JsonResponse;

/**
 * Class Domian.
 *
 * @package Woisks\Jwt\Middleware
 *
 * @Author  Maple Grove  <bolelin@126.com> 2019/7/21 14:31
 */
class Domian
{
    /**
     * handle. 2019/7/21 14:31.
     *
     * @param          $request
     * @param \Closure $next
     *
     * @return JsonResponse|mixed
     */
    public function handle($request, Closure $next)
    {
        $host = request()->header('host');

        $bool = collect(config('woisk.url'))->filter(function ($value) use ($host) {
            return $value == $host;

        });

        if (!$bool->isEmpty()) {

            return $next($request);
        }

        return res(422, 'url param error');

    }

}
