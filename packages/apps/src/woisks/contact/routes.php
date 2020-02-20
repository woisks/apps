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


Route::prefix('contact')
    ->middleware('throttle:60,1')
    ->namespace('Woisks\Contact\Http\Controllers')
    ->group(function () {

        Route::get('/{folder_id}', 'ContactController@folder_get')->where(['folder_id' => '[0-9]+']);
        Route::get('/isp', 'ISPController@get');

        Route::middleware('token')->group(function () {

            Route::post('/', 'ContactController@create');
            Route::post('/delete/{id}', 'ContactController@delete')->where(['id' => '[0-9]+']);

        });

    });




