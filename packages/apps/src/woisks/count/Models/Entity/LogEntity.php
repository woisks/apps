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
 * Class LogEntity.
 *
 * @package Woisks\Count\Models\Entity
 *
 * @Author Maple Forest  <Woisks@126.com> 2019/11/22 19:27
 */
class LogEntity extends Models
{
    /**
     * table.  2019/11/22 19:27.
     *
     * @var  string
     */
    protected $table = 'count_log';
    /**
     * fillable.  2019/11/22 19:27.
     *
     * @var  array
     */
    protected $fillable = [
        'id',
        'account_uid',
        'module_id',
        'action_id',
        'numeric',
        'created_at',
        'updated_at',
        'status'
    ];
}
