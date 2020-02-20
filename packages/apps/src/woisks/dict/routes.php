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


Route::prefix('dict')
    ->middleware('throttle:60,1')
    ->namespace('Woisks\Dict\Http\Controllers')
    ->group(function () {

        Route::post('/', 'CreateController@create');
        Route::get('/', 'GetController@first');
//        Route::post('/delete', 'DeleteController@delete');

    });
