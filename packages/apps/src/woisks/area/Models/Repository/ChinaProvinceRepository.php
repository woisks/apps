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


use Woisks\Area\Models\Entity\ChinaProvinceEntity;

/**
 * Class ChinaProvinceRepository.
 *
 * @package Woisks\Area\Models\Repository
 *
 * @Author  Maple Grove  <bolelin@126.com> 2019/6/10 10:28
 */
class ChinaProvinceRepository
{

    /**
     * model.  2019/7/28 18:54.
     *
     * @var static ChinaProvinceEntity
     */
    private static $model;

    /**
     * ChinaProvinceRepository constructor. 2019/7/28 18:54.
     *
     * @param  ChinaProvinceEntity  $province
     *
     * @return void
     */
    public function __construct(ChinaProvinceEntity $province)
    {
        self::$model = $province;
    }


    /**
     * all. 2019/7/28 18:54.
     *
     *
     * @return mixed
     */
    public function all()
    {
        return self::$model->select('province_id as province', 'short_name as name', 'china_region as region')->get();
    }


}
