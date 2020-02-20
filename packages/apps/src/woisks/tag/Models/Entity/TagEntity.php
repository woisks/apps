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

namespace Woisks\Tag\Models\Entity;


/**
 * Class TagEntity.
 *
 * @package Woisks\Tag\Models\Entity
 *
 * @Author Maple Forest  <Woisks@126.com> 2019/11/22 19:40
 */
class TagEntity extends models
{
    /**
     * table.  2019/11/22 19:40.
     *
     * @var  string
     */
    protected $table = 'tag';
    /**
     * fillable.  2019/11/22 19:40.
     *
     * @var  array
     */
    protected $fillable   = [
        'id',
        'name',
        'count',
        'count',
        'status',
        'is_root',
        'is_alias',
        'is_locking'
    ];
    public    $timestamps = false;
}
