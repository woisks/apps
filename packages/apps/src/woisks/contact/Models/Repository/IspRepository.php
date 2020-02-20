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

namespace Woisks\Contact\Models\Repository;


use Woisks\Contact\Models\Entity\IspEntity;

/**
 * Class IspRepository.
 *
 * @package Woisks\Contact\Models\Repository
 *
 * @Author Maple Grove  <Woisks@126.com> 2020/2/1 11:47
 */
class IspRepository
{
    /**
     * @var IspEntity
     */
    private static $model;

    /**
     * IspRepository constructor. 2020/2/1 11:47.
     *
     * @param  IspEntity  $isp
     *
     * @return void
     */
    public function __construct(IspEntity $isp)
    {
        self::$model = $isp;
    }

    /**
     * exists. 2020/2/1 11:47.
     *
     * @param $isp_id
     *
     * @return mixed
     */
    public function exists($isp_id)
    {
        return self::$model->where('id', $isp_id)->exists();
    }

    /**
     * increment. 2020/2/1 17:01.
     *
     * @param $id
     *
     * @return int
     */
    public function increment($id): int
    {
        return self::$model->where('id', $id)->increment('count');
    }


    /**
     * decrement. 2020/2/1 17:01.
     *
     * @param $id
     *
     * @return int
     */
    public function decrement($id): int
    {
        return self::$model->where('id', $id)->decrement('count');
    }

    /**
     * get. 2020/2/1 18:29.
     *
     *
     * @return \Illuminate\Database\Eloquent\Collection|IspEntity[]
     */
    public function get()
    {
        return self::$model->all();
    }
}
