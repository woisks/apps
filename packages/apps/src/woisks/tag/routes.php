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


Route::prefix('tag')
    ->middleware('throttle:60,1')
    ->namespace('Woisks\Tag\Http\Controllers')
    ->group(function () {

        Route::get('/', 'TagController@get');
        Route::get('/index/{tag_id}', 'TagController@index')->where(['tag_id' => '[0-9]+']);

        Route::middleware('token')->group(function () {
            Route::post('/', 'TagController@create');
        });


    });




