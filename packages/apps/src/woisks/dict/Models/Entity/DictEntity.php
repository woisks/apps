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

namespace Woisks\Dict\Models\Entity;


/**
 * Class Dict.
 *
 * @package Woisks\Dict\Models\Entity
 *
 * @Author Maple Forest  <Woisks@126.com> 2020/1/21 15:17
 */
class DictEntity extends Models
{
    /**
     * @var string
     */
    protected $table = 'dict';
    /**
     * @var array
     */
    protected $fillable = [
        'id', 'alias', 'name'
    ];

    /**
     * @var bool
     */
    public $timestamps = false;
}