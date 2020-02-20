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


Route::prefix('count')
    ->middleware('throttle:60,1')
    ->namespace('Woisks\Count\Http\Controllers')
    ->group(function () {

        Route::get('/{numeric}/{module}/{action}', 'LogController@get')->where([
            'numeric' => '[0-9]+', 'module' => '[a-z]+', 'action' => '[a-z]+'
        ]);
        Route::get('/user/{uid}/{module}/{action}', 'LogController@user_get')->where([
            'uid' => '[0-9]+', 'module' => '[a-z]+', 'action' => '[a-z]+'
        ]);
        Route::middleware('token')->group(function () {
            Route::post('/', 'CountController@change');
        });

    });




