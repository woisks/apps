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

namespace Woisks\Passport\Models\Services;


use Woisks\Passport\Models\Repository\TypeCountRepository;

/**
 * Class TypeCountServices.
 *
 * @package Woisks\Passport\Models\Services
 *
 * @Author Maple Grove  <Woisks@126.com> 2020/1/29 13:06
 */
class TypeCountServices
{

    /**
     * increment. 2020/1/29 13:08.
     *
     * @param  string  $account_type
     *
     * @return mixed
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public static function increment(string $account_type)
    {
        return app()->make(TypeCountRepository::class)->typeIncrement($account_type);

    }

    /**
     * decrement. 2020/1/29 13:08.
     *
     * @param  string  $account_type
     *
     * @return mixed
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public static function decrement(string $account_type)
    {
        return app()->make(TypeCountRepository::class)->typeDecrement($account_type);
    }

    /**
     * user_add. 2020/1/29 13:08.
     *
     *
     * @return mixed
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public static function user_add()
    {
        return app()->make(TypeCountRepository::class)->passport_user_add();
    }
}