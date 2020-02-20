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

namespace Woisks\Captcha\Models\Repository;


use Woisks\Captcha\Models\Entity\Today;

class TodayRepository
{
    private static $model;

    public function __construct(Today $today)
    {
        self::$model = $today;
    }

}
