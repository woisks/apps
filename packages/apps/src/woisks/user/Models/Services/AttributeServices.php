<?php

declare(strict_types=1);

/*
 * +----------------------------------------------------------------------+
 * |                   At all timesI love the moment                      |
 * +----------------------------------------------------------------------+
 * | Copyright (c) 2019 www.Woisk.com All rights reserved.                |
 * +----------------------------------------------------------------------+
 * |  Author:  Maple Grove  <Woisks@126.com>   QQ:364956690   286013629  |
 * +----------------------------------------------------------------------+
 */

namespace Woisks\User\Models\Services;


use Woisks\User\Models\Repository\AttributeRepository;

/**
 * Class AttributeServices.
 *
 * @package Woisks\User\Models\Services
 *
 * @Author Maple Grove  <Woisks@126.com> 2020/1/31 13:37
 */
class AttributeServices
{
    /**
     * first. 2020/1/31 15:06.
     *
     * @param $id
     *
     * @return mixed
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public static function first($id)
    {
        return app()->make(AttributeRepository::class)->first($id);
    }

    /**
     * increment. 2020/1/31 13:42.
     *
     * @param  string  $alias
     *
     * @return int
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function increment(string $alias): int
    {
        return app()->make(AttributeRepository::class)->increment($alias);
    }


    /**
     * decrement. 2020/1/31 13:42.
     *
     * @param  string  $alias
     *
     * @return int
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function decrement(string $alias): int
    {
        return app()->make(AttributeRepository::class)->decrement($alias);
    }
}