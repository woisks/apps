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

namespace Woisks\Count\Models\Repository;


use Woisks\Count\Models\Entity\CountEntity;

/**
 * Class CountRepository.
 *
 * @package Woisks\Count\Models\Repository
 *
 * @Author Maple Forest  <Woisks@126.com> 2019/11/23 18:02
 */
class CountRepository
{
    /**
     * @var CountEntity
     */
    private static $model;

    /**
     * CountRepository constructor. 2019/11/23 18:02.
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
     * increment. 2020/2/2 12:02.
     *
     * @param $module_id
     * @param $action_id
     * @param $numeric
     *
     * @return mixed
     */
    public function increment($module_id, $action_id, $numeric)
    {
        $db = self::$model->firstOrCreate([
            'numeric'   => $numeric,
            'module_id' => $module_id,
            'action_id' => $action_id
        ], ['id' => create_numeric_id()]);

        if ($db) {
            //存在统计自增
            $db->increment('count');
        }
        return $db;
    }

    /**
     * decrement. 2020/2/2 12:02.
     *
     * @param $module_id
     * @param $action_id
     * @param $numeric
     *
     * @return mixed
     */
    public function decrement($module_id, $action_id, $numeric)
    {
        $db = self::$model->where('numeric', $numeric)
            ->where('module_id', $module_id)
            ->where('action_id', $action_id)
            ->first();

        if ($db && $db->count > 0) {
            //统计自减
            $db->decrement('count');
        }
        return $db;
    }

}