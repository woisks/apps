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

namespace Woisks\Count\Models\Entity;


/**
 * Class CountEntity.
 *
 * @package Woisks\Count\Models\Entity
 *
 * @Author Maple Forest  <Woisks@126.com> 2019/11/22 19:26
 */
class CountEntity extends Models
{
    /**
     * table.  2019/11/22 19:26.
     *
     * @var  string
     */
    protected $table = 'count';
    /**
     * fillable.  2019/11/22 19:26.
     *
     * @var  array
     */
    protected $fillable = [
        'id',
        'module_id',
        'action_id',
        'numeric',
        'count'
    ];
    /**
     * @var bool
     */
    public $timestamps = false;
}
