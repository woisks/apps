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


use Illuminate\Database\Eloquent\Model;


/**
 * Class Models.
 *
 * @package Woisks\Contact\Models\Entity
 *
 * @Author Maple Forest  <Woisks@126.com> 2019/11/22 19:15
 */
class Models extends Model
{
    /**
     * incrementing.  2019/11/22 18:39.
     *
     * @var  bool
     */
    public $incrementing = false;

    /**
     * dateFormat.  2019/11/22 18:39.
     *
     * @var  string
     */
    protected $dateFormat = 'U';

    /**
     * getCreatedAtAttribute 2019/6/8 1:12
     *
     * @param $value
     *
     * @return false|string
     */
    public function getCreatedAtAttribute($value)
    {
        return date('Y-m-d H:i:s', (int)$value);
    }

    /**
     * getUpdatedAtAttribute 2019/6/8 1:12
     *
     * @param $value
     *
     * @return false|string
     */
    public function getUpdatedAtAttribute($value)
    {
        return date('Y-m-d H:i:s', (int)$value);
    }
}
