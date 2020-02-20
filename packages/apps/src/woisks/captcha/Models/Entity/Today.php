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

namespace Woisks\Captcha\Models\Entity;


class Today extends Models
{
    public $timestamps = false;
    /**
     * table  2019/5/10 11:47
     *
     * @var string
     */
    protected $table = 'captcha_today_send_count';
    /**
     * fillable  2019/5/10 11:47
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'type',
        'date',
        'count'
    ];
}
