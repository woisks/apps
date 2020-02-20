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

namespace Woisks\Dict\Models\Services;


use Woisks\Dict\Models\Repository\DictRepository;

/**
 * Class DictGetServices.
 *
 * @package Woisks\Dict\Models\Services
 *
 * @Author Maple Forest  <Woisks@126.com> 2020/1/23 12:31
 */
class DictGetServices
{
    /**
     * @var DictRepository
     */
    private $dictRepo;

    /**
     * DictDeleteServices constructor. 2020/1/21 15:44.
     *
     * @param  DictRepository  $dictRepo
     *
     * @return void
     */
    public function __construct(DictRepository $dictRepo)
    {
        $this->dictRepo = $dictRepo;
    }

    /**
     * first. 2020/1/23 12:31.
     *
     * @param  string  $alias
     *
     * @return mixed
     */
    public function first(string $alias)
    {
        return $this->dictRepo->alias($alias);
    }

    /**
     * id. 2020/1/31 19:57.
     *
     * @param $id
     *
     * @return mixed
     */
    public function id($id)
    {
        return $this->dictRepo->id($id);
    }

    /**
     * get. 2020/1/31 18:13.
     *
     * @param $alias
     *
     * @return mixed
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public static function get($alias)
    {
        return app()->make(DictGetServices::class)->first($alias);
    }

    /**
     * get_id. 2020/1/31 19:57.
     *
     * @param $id
     *
     * @return mixed
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public static function get_id($id)
    {
        return app()->make(DictGetServices::class)->id($id);
    }
}