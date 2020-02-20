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

namespace Woisks\User\Models\Repository;


use Woisks\User\Models\Entity\AttributeEntity;

/**
 * Class AttributeRepository.
 *
 * @package Woisks\User\Models\Repository
 *
 * @Author Maple Forest  <Woisks@126.com> 2019/11/21 12:48
 */
class AttributeRepository
{

    /**
     * model.  2019/11/21 12:48.
     *
     * @var static AttributeEntity
     */
    private static $model;


    /**
     * AttributeRepository constructor. 2019/11/21 12:48.
     *
     * @param  AttributeEntity  $attribute
     *
     * @return void
     */
    public function __construct(AttributeEntity $attribute)
    {
        self::$model = $attribute;
    }

    /**
     * first. 2020/1/31 13:39.
     *
     * @param $id
     *
     * @return mixed
     */
    public function first($id)
    {
        return self::$model->where('id', $id)->first();
    }

    /**
     * increment. 2020/1/31 13:41.
     *
     * @param  string  $alias
     *
     * @return int
     */
    public function increment(string $alias): int
    {
        return self::$model->where('alias', $alias)->increment('count');
    }


    /**
     * decrement. 2020/1/31 13:41.
     *
     * @param  string  $alias
     *
     * @return int
     */
    public function decrement(string $alias): int
    {
        return self::$model->where('alias', $alias)->decrement('count');
    }
}
