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

namespace Woisks\User\Models\Entity;


use Illuminate\Database\Eloquent\Model;

/**
 * Class Models.
 *
 * @package Woisks\User\Models\Entity
 *
 * @Author  Maple Grove  <bolelin@126.com> 2019/6/8 20:59
 */
class Models extends Model
{
    /**
     * incrementing  2019/5/22 22:10
     *
     * @var  bool
     */
    public $incrementing = false;
    /**
     * dateFormat  2019/6/6 16:21
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


    /**
     * getNameLastTimeAttribute. 2019/6/8 20:59.
     *
     * @param $value
     *
     * @return false|string
     */
    public function getNameLastTimeAttribute($value)
    {
        return date('Y-m-d H:i:s', (int)$value);
    }


}