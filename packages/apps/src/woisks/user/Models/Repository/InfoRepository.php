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

namespace Woisks\User\Models\Repository;


use Woisks\User\Models\Entity\InfoEntity;

/**
 * Class InfoRepository.
 *
 * @package Woisks\User\Models\Repository
 *
 * @Author Maple Forest  <Woisks@126.com> 2019/11/21 12:48
 */
class InfoRepository
{
    /**
     * model.  2019/7/28 16:47.
     *
     * @var static InfoEntity
     */
    private static $model;

    /**
     * InfoRepository constructor. 2019/11/21 12:47.
     *
     * @param  InfoEntity  $info
     *
     * @return void
     */
    public function __construct(InfoEntity $info)
    {
        self::$model = $info;
    }

    /**
     * get. 2020/1/31 14:51.
     *
     * @param $account_uid
     *
     * @return mixed
     */
    public function get($account_uid)
    {
        return self::$model->where('account_uid', $account_uid)->get();
    }
}
