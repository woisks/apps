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

namespace Woisks\Contact\Models\Entity;


/**
 * Class ContactEntity.
 *
 * @package Woisks\Contact\Models\Entity
 *
 * @Author Maple Forest  <Woisks@126.com> 2019/11/22 19:17
 */
class ContactEntity extends Models
{
    /**
     * table.  2019/11/22 19:17.
     *
     * @var  string
     */
    protected $table = 'contact';
    /**
     * fillable.  2019/11/22 19:17.
     *
     * @var  array
     */
    protected $fillable = [
        'id',
        'account_uid',
        'folder_id',
        'isp_id',
        'passport',
        'qrcode_photo_id',
        'title',
        'readme',
        'created_at',
        'updated_at'
    ];
}
