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


class ArticleEntity extends Models
{
    protected $table = 'article';

    protected $fillable = [
        'id',
        'account_uid',
        'folder_id',
        'cover_photo_id',
        'title',
        'summary',
        'created_at',
        'updated_at',
        'is_comment',
        'words',
        'status'
    ];

}
