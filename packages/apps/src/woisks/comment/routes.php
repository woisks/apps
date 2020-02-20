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


Route::prefix('comment')
    ->middleware('throttle:60,1')
    ->namespace('Woisks\Comment\Http\Controllers')
    ->group(function () {

        Route::get('/user/{uid}', 'CommentController@get_uid')->where(['uid' => '[0-9]+']);
        Route::get('/reply/{id}', 'CommentController@reply')->where(['id' => '[0-9]+']);
        Route::get('/module/{module}/{numeric}', 'CommentController@module_numeric')->where([
            'module'  => '[a-z]+',
            'numeric' => '[0-9]+'
        ]);

        Route::middleware('token')->group(function () {
            Route::post('/', 'CommentController@create');
            Route::post('/delete/{id}', 'CommentController@delete')->where(['id' => '[0-9]+']);
        });

    });




