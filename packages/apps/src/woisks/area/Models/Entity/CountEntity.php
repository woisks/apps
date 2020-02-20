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

namespace Woisks\Area\Models\Entity;


/**
 * Class CountEntity.
 *
 * @package Woisks\Area\Models\Entity
 *
 * @Author Maple Grove  <bolelin@126.com> 2019/8/4 14:09
 */
class CountEntity extends Models
{
    /**
     * table.  2019/8/4 14:09.
     *
     * @var  string
     */
    protected $table = 'area_count';

    /**
     * fillable.  2019/8/4 14:09.
     *
     * @var  array
     */
    protected $fillable = [
        'id',
        'type',
        'table',
        'numeric',
        'count'
    ];

    /**
     * incrementing.  2019/8/4 14:09.
     *
     * @var  bool
     */
    public $incrementing = false;
}
