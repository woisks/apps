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

namespace Woisks\Folder\Models\Entity;


/**
 * Class FolderEntity.
 *
 * @package Woisks\Folder\Models\Entity
 *
 * @Author Maple Forest  <Woisks@126.com> 2019/11/22 19:32
 */
class FolderEntity extends Models
{
    /**
     * table.  2019/11/22 19:32.
     *
     * @var  string
     */
    protected $table = 'folder';
    /**
     * fillable.  2019/11/22 19:32.
     *
     * @var  array
     */
    protected $fillable = [
        'id',
        'account_uid',
        'module_id',
        'cover_photo_id',
        'title',
        'readme',
        'created_at',
        'updated_at',
        'status',
        'count',
        'is_public'
    ];
}
