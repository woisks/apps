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


use Woisks\Area\Models\Entity\ChinaCountyEntity;

/**
 * Class ChinaCountyRepository.
 *
 * @package Woisks\Area\Models\Repository
 *
 * @Author  Maple Grove  <bolelin@126.com> 2019/6/10 20:51
 */
class ChinaCountyRepository
{

    /**
     * model.  2019/7/28 18:54.
     *
     * @var static ChinaCountyEntity
     */
    private static $model;


    /**
     * ChinaCountyRepository constructor. 2019/7/28 18:54.
     *
     * @param  ChinaCountyEntity  $county
     *
     * @return void
     */
    public function __construct(ChinaCountyEntity $county)
    {
        self::$model = $county;
    }


    /**
     * get. 2019/7/28 18:54.
     *
     * @param $city_id
     *
     * @return mixed
     */
    public function get($city_id)
    {
        return self::$model->where('city_id', $city_id)->select('county_id as county', 'short_name as name')->get();
    }


}
