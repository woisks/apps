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

namespace Woisks\Dict\Models\Repository;

use Woisks\Dict\Models\Entity\DictEntity;

/**
 * Class DictRepository.
 *
 * @package Woisks\Dict\Models\Repository
 *
 * @Author Maple Forest  <Woisks@126.com> 2020/1/21 15:47
 */
class DictRepository
{

    /**
     * @var DictEntity
     */
    private static $model;

    /**
     * DictRepository constructor. 2020/1/21 15:47.
     *
     * @param  DictEntity  $dict
     *
     * @return void
     */
    public function __construct(DictEntity $dict)
    {
        self::$model = $dict;
    }

    /**
     * create. 2020/1/21 15:47.
     *
     * @param $id
     * @param $alias
     * @param $name
     *
     * @return mixed
     */
    public function create($id, $alias, $name)
    {
        return self::$model->create(['id' => $id, 'alias' => $alias, 'name' => $name]);
    }

    /**
     * delete. 2020/1/21 15:53.
     *
     * @param $id
     *
     * @return mixed
     */
    public function delete($id)
    {
        return self::$model->where('id', $id)->delete();
    }

    /**
     * alias. 2020/1/23 12:35.
     *
     * @param $alias
     *
     * @return mixed
     */
    public function alias($alias)
    {
        return self::$model->where('alias', $alias)->first();
    }

    public function id($id)
    {
        return self::$model->where('id', $id)->first();
    }
}