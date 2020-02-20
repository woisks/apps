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

namespace Woisks\User\Models\Entity;


class InfoEntity extends Models
{
    /**
     * table.  2019/6/8 13:19.
     *
     * @var  string
     */
    protected $table = 'user_info';
    /**
     * fillable.  2019/6/8 13:19.
     *
     * @var  array
     */
    protected $fillable = [
        'id',
        'account_uid',
        'attribute_id',
        'value',
        'created_at',
        'updated_at'
    ];
}
