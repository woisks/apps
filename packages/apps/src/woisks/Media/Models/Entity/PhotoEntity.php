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

namespace Woisks\Media\Models\Entity;


/**
 * Class MediaEntity.
 *
 * @package Woisks\Media\Models\Entity
 *
 * @Author  Maple Grove  <bolelin@126.com> 2019/6/10 23:41
 */
class PhotoEntity extends Models
{
    /**
     * table.  2019/6/10 23:41.
     *
     * @var  string
     */
    protected $table = 'photo';
    /**
     * fillable.  2019/6/10 23:41.
     *
     * @var  array
     */
    protected $fillable = [
        'id',
        'account_uid',
        'module_id',
        'folder_id',
        'title',
        'readme',
        'created_at',
        'updated_at',
        'status',
        'is_comment',
    ];
}
