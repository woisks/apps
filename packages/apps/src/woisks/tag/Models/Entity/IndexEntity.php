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
 * Class IndexEntity.
 *
 * @package Woisks\Tag\Models\Entity
 *
 * @Author Maple Forest  <Woisks@126.com> 2019/11/22 19:41
 */
class IndexEntity extends Models
{
    /**
     * table.  2019/11/22 19:41.
     *
     * @var  string
     */
    protected $table = 'tag_index';
    /**
     * fillable.  2019/11/22 19:41.
     *
     * @var  array
     */
    protected $fillable   = [
        'id',
        'module_id',
        'tag_id',
        'count'
    ];
    public    $timestamps = false;
}
