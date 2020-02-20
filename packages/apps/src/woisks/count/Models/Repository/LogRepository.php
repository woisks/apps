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

namespace Woisks\Count\Models\Repository;


use Woisks\Count\Models\Entity\LogEntity;

/**
 * Class LogRepository.
 *
 * @package Woisks\Count\Models\Repository
 *
 * @Author Maple Grove  <Woisks@126.com> 2020/2/2 11:09
 */
class LogRepository
{


    /**
     * @var LogEntity
     */
    private static $model;


    /**
     * LogRepository constructor. 2020/2/2 11:09.
     *
     *
     * @return void
     */
    public function __construct()
    {
        self::$model = new LogEntity();
    }


    /**
     * create. 2020/2/2 11:35.
     *
     * @param $uid
     * @param $module_id
     * @param $action_id
     * @param $numeric
     *
     * @return mixed
     */
    public function create($uid, $module_id, $action_id, $numeric)
    {
        return self::$model->create([
            'id'          => create_numeric_id(),
            'account_uid' => $uid,
            'module_id'   => $module_id,
            'action_id'   => $action_id,
            'numeric'     => $numeric,
        ]);
    }

    /**
     * first. 2020/2/2 11:58.
     *
     * @param $uid
     * @param $module_id
     * @param $action_id
     * @param $numeric
     *
     * @return mixed
     */
    public function first($uid, $module_id, $action_id, $numeric)
    {
        return self::$model->where('account_uid', $uid)
            ->where('module_id', $module_id)
            ->where('action_id', $action_id)
            ->where('numeric', $numeric)
            ->first();
    }

    /**
     * numeric_module_action_get. 2020/2/2 14:30.
     *
     * @param $numeric
     * @param $module_id
     * @param $action_id
     *
     * @return mixed
     */
    public function numeric_module_action_get($numeric, $module_id, $action_id)
    {
        return self::$model->where('numeric', $numeric)
            ->where('module_id', $module_id)
            ->where('action_id', $action_id)
            ->paginate();
    }

    /**
     * numeric_module. 2020/2/2 14:32.
     *
     * @param $numeric
     * @param $module_id
     *
     * @return mixed
     */
    public function numeric_module($numeric, $module_id)
    {
        return self::$model->where('numeric', $numeric)
            ->where('module_id', $module_id)
            ->paginate();
    }

    /**
     * uid_module_action_get. 2020/2/2 16:27.
     *
     * @param $uid
     * @param $module_id
     * @param $action_id
     *
     * @return mixed
     */
    public function uid_module_action_get($uid, $module_id, $action_id)
    {
        return self::$model->where('account_uid', $uid)
            ->where('module_id', $module_id)
            ->where('action_id', $action_id)
            ->paginate();
    }

    /**
     * uid_module_get. 2020/2/2 16:27.
     *
     * @param $uid
     * @param $module_id
     *
     * @return mixed
     */
    public function uid_module_get($uid, $module_id)
    {
        return self::$model->where('account_uid', $uid)->where('module_id', $module_id)->paginate();
    }
}