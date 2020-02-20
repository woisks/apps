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


use Woisks\Area\Models\Entity\CountryEntity;

/**
 * Class CountryRepository.
 *
 * @package Woisks\Area\Models\Repository
 *
 * @Author  Maple Grove  <bolelin@126.com> 2019/6/10 10:19
 */
class CountryRepository
{

    /**
     * model.  2019/7/28 18:18.
     *
     * @var static CountryEntity
     */
    private static $model;


    /**
     * CountryRepository constructor. 2019/7/28 18:55.
     *
     * @param  CountryEntity  $country
     *
     * @return void
     */
    public function __construct(CountryEntity $country)
    {
        self::$model = $country;
    }

    /**
     * all. 2019/7/28 18:56.
     *
     *
     * @return mixed
     */
    public function all()
    {
        return self::$model->all();
    }


}
