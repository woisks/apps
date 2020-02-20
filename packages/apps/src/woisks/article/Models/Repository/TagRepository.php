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

namespace Woisks\Article\Models\Repository;


use Woisks\Article\Models\Entity\TagEntity;

class TagRepository
{
    private static $model;

    public function __construct(TagEntity $tag)
    {
        self::$model = $tag;
    }


}
