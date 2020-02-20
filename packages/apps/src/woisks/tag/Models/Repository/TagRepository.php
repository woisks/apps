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


use Woisks\Tag\Models\Entity\TagEntity;


/**
 * Class TagRepository.
 *
 * @package Woisks\Tag\Models\Repository
 *
 * @Author Maple Grove  <Woisks@126.com> 2020/1/31 18:18
 */
class TagRepository
{

    /**
     * @var TagEntity
     */
    private static $model;


    /**
     * TagRepository constructor. 2020/1/31 18:18.
     *
     * @param  TagEntity  $tag
     *
     * @return void
     */
    public function __construct(TagEntity $tag)
    {
        self::$model = $tag;
    }

    /**
     * firstOrCreate. 2019/11/23 17:21.
     *
     * @param $tag
     *
     * @return mixed
     */
    public function firstOrCreate($tag)
    {
        $db = self::$model->firstOrCreate(['name' => $tag], ['id' => create_numeric_id()]);
        $db->increment('count');
        return $db;
    }

    /**
     * find. 2020/1/31 19:22.
     *
     * @param $tags
     *
     * @return mixed
     */
    public function find($tags)
    {
        return self::$model->find($tags);
    }

}