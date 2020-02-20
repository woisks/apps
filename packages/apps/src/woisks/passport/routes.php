<?php
declare(strict_types=1);


Route::prefix('passport')
    ->middleware('throttle:60,1')
    ->namespace('Woisks\Passport\Http\Controllers')
    ->group(function () {

        if (config('woisk.passport.register_captcha_middleware')) {
            Route::post('register', 'RegisterController@register')->middleware('captcha');
        } else {
            Route::post('register', 'RegisterController@register');
        }

        Route::any('check/{type}/{username}', 'CheckController@check')->where(['type' => '[a-z]+']);

        Route::post('login', 'LoginController@login');

        Route::post('password/reset', 'PasswordController@reset');

        Route::middleware('token')->group(function () {

            Route::post('logout', 'LogoutController@logout');

            Route::post('online', 'StatusController@online');
            Route::post('offline/{mac}', 'StatusController@offline')->where(['mac' => '[0-9]+']);

            Route::post('/', 'PassportController@get');
            Route::post('add', 'PassportController@add');
            Route::post('del', 'PassportController@del');

            Route::post('password/update', 'PasswordController@update');

            Route::post('bind', 'PassportController@bind')->middleware('captcha');
            Route::post('update', 'PassportController@update')->middleware('captcha');

        });

    });




