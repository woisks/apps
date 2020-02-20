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

namespace Woisks\Tag\Models\Repository;


use Woisks\Tag\Models\Entity\IndexEntity;


/**
 * Class IndexRepository.
 *
 * @package Woisks\Tag\Models\Repository
 *
 * @Author Maple Grove  <Woisks@126.com> 2020/1/31 18:18
 */
class IndexRepository
{

    /**
     * @var IndexEntity
     */
    private static $model;

    /**
     * IndexRepository constructor. 2020/1/31 18:18.
     *
     * @param  IndexEntity  $index
     *
     * @return void
     */
    public function __construct(IndexEntity $index)
    {
        self::$model = $index;
    }

    /**
     * firstOrCretae. 2020/1/31 18:18.
     *
     * @param $module_id
     * @param $tag_id
     *
     * @return mixed
     */
    public function firstOrCretae($module_id, $tag_id)
    {
        $db = self::$model->firstOrCreate(['module_id' => $module_id, 'tag_id' => $tag_id],
            ['id' => create_numeric_id()]);
        $db->increment('count');
        return $db;
    }

    /**
     * get. 2020/1/31 19:51.
     *
     * @param $tag_id
     *
     * @return mixed
     */
    public function get($tag_id)
    {
        return self::$model->where('tag_id', $tag_id)->get();
    }
}