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

Route::prefix('area')
    ->namespace('Woisks\Area\Http\Controllers')
    ->middleware('throttle:60,1')
    ->group(function () {

        Route::get('/', 'AreaController@country');
        Route::get('/province', 'AreaController@province');
        Route::get('/city/{province_id}', 'AreaController@city')->where(['province_id' => '[0-9]+']);
        Route::get('/county/{city_id}', 'AreaController@county')->where(['city_id' => '[0-9]+']);
        Route::get('/town/{county_id}', 'AreaController@town')->where(['county_id' => '[0-9]+']);
        Route::get('/numeric/{type}/{table}/{id}', 'GetController@first')->where([
            'type'  => '[a-z_a-z]+',
            'table' => '[a-z]+', 'id' => '[0-9]+'
        ]);
    });
