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

Route::prefix('user')
    ->middleware('throttle:60,1')
    ->namespace('Woisks\User\Http\Controllers')
    ->group(function () {


        //根据uid获取用户信息
        Route::get('/{account_uid}/{param}', 'GetController@getUser')->where([
            'account_uid' => '[0-9]+', 'param' => '[a-z]+'
        ]);

        Route::middleware('token')->group(function () {
            Route::post('/', 'UserController@create');
        });
    });
