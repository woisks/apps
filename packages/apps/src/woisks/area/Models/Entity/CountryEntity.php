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
 * Class CountryEntity.
 *
 * @package Woisks\Area\Models\Entity
 *
 * @Author  Maple Grove  <bolelin@126.com> 2019/6/10 9:56
 */
class CountryEntity extends Models
{
    /**
     * table.  2019/6/10 9:56.
     *
     * @var  string
     */
    protected $table = 'area_country';
    /**
     * hidden.  2019/7/18 20:27.
     *
     * @var  array
     */
    protected $hidden = [
        'status',
        'region'
    ];

}