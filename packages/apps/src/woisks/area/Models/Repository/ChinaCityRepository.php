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

namespace Woisks\Area\Models\Repository;


use Woisks\Area\Models\Entity\ChinaCityEntity;

/**
 * Class ChinaCityRepository.
 *
 * @package Woisks\Area\Models\Repository
 *
 * @Author  Maple Grove  <bolelin@126.com> 2019/6/10 10:59
 */
class ChinaCityRepository
{

    /**
     * model.  2019/7/28 18:54.
     *
     * @var static ChinaCityEntity
     */
    private static $model;


    /**
     * ChinaCityRepository constructor. 2019/7/28 18:54.
     *
     * @param  ChinaCityEntity  $city
     *
     * @return void
     */
    public function __construct(ChinaCityEntity $city)
    {
        self::$model = $city;
    }


    /**
     * get. 2019/7/28 18:54.
     *
     * @param $province_id
     *
     * @return mixed
     */
    public function get($province_id)
    {
        return self::$model->where('province_id', $province_id)->select('city_id as city', 'short_name as name')->get();
    }


}
