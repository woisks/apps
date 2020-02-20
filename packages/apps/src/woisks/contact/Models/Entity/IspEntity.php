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

namespace Woisks\Contact\Models\Entity;


/**
 * Class IspEntity.
 *
 * @package Woisks\Contact\Models\Entity
 *
 * @Author Maple Forest  <Woisks@126.com> 2019/11/22 19:18
 */
class IspEntity extends Models
{
    /**
     * table.  2019/11/22 19:18.
     *
     * @var  string
     */
    protected $table = 'contact_isp';
    /**
     * fillable.  2019/11/22 19:18.
     *
     * @var  array
     */
    protected $fillable = [
        'id',
        'alias',
        'name',
        'readme',
        'url',
        'status',
        'count'
    ];

    public $timestamps = false;
}
