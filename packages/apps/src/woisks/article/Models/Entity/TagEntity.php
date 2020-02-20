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

namespace Woisks\Article\Models\Entity;


/**
 * Class TagEntity.
 *
 * @package Woisks\Article\Models\Entity
 *
 * @Author Maple Forest  <Woisks@126.com> 2019/11/22 18:49
 */
class TagEntity extends Models
{
    /**
     * table.  2019/11/22 18:49.
     *
     * @var  string
     */
    protected $table = 'article_tag';
    /**
     * fillable.  2019/11/22 18:49.
     *
     * @var  array
     */
    protected $fillable = [
        'id',
        'article_id',
        'tag_id'
    ];
}
