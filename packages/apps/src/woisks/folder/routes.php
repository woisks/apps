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


Route::prefix('folder')
    ->middleware('throttle:60,1')
    ->namespace('Woisks\Folder\Http\Controllers')
    ->group(function () {

        //获取用户公开的文件夹
        Route::get('/{uid}/{module}', 'FolderController@public_folder')->where([
            'uid' => '[0-9]+', 'module' => '[a-z]+'
        ]);


        Route::middleware('token')->group(function () {
            //获取会员自己的文件夹
            Route::post('/{module}', 'FolderController@get');

            //创建文件夹
            Route::post('/', 'FolderController@create');

            //修改文件夹
            Route::post('/update/{id}', 'FolderController@update')->where(['id' => '[0-9]+']);

            //删除文件夹
            Route::post('/delete/{id}', 'FolderController@delete')->where(['id' => '[0-9]+']);


        });

    });




