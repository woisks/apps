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

namespace Woisks\Comment\Models\Entity;


/**
 * Class CommentEntity.
 *
 * @package Woisks\Comment\Models\Entity
 *
 * @Author Maple Forest  <Woisks@126.com> 2019/11/22 19:09
 */
class CommentEntity extends Models
{
    /**
     * table.  2019/11/22 19:09.
     *
     * @var  string
     */
    protected $table = 'comment';
    /**
     * fillable.  2019/11/22 19:09.
     *
     * @var  array
     */
    protected $fillable = [
        'id',
        'account_uid',
        'module_id',
        'numeric',
        'content',
        'created_at',
        'updated_at',
        'parent_id',
        'is_reply',
        'reply_count',
        'status'
    ];
}
