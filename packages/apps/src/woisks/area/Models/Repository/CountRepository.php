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

namespace Woisks\Area\Models\Repository;


use Woisks\Area\Models\Entity\CountEntity;

/**
 * Class CountRepository.
 *
 * @package Woisks\Area\Models\Repository
 *
 * @Author Maple Grove  <bolelin@126.com> 2019/8/4 15:16
 */
class CountRepository
{
    /**
     * model.  2019/8/4 15:16.
     *
     * @var static CountEntity
     */
    private static $model;

    /**
     * CountRepository constructor. 2019/8/4 15:16.
     *
     * @param  CountEntity  $count
     *
     * @return void
     */
    public function __construct(CountEntity $count)
    {
        self::$model = $count;
    }

    /**
     * first. 2019/8/4 15:23.
     *
     * @param $type
     * @param $table
     * @param $numeric
     *
     * @return mixed
     */
    public function first($type, $table, $numeric)
    {
        return self::$model->where('type', $type)->where('table', $table)->where('numeric', $numeric)->first();
    }


}
