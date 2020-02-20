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

namespace Woisks\Comment\Models\Repository;


use Woisks\Comment\Models\Entity\CommentEntity;

/**
 * Class CommentRepository.
 *
 * @package Woisks\Comment\Models\Repository
 *
 * @Author Maple Grove  <Woisks@126.com> 2020/2/1 10:16
 */
class CommentRepository
{
    /**
     * @var CommentEntity
     */
    private static $model;

    /**
     * CommentRepository constructor. 2020/2/1 10:16.
     *
     * @param  CommentEntity  $comment
     *
     * @return void
     */
    public function __construct(CommentEntity $comment)
    {
        self::$model = $comment;
    }

    /**
     * create. 2020/2/1 10:16.
     *
     * @param $uid
     * @param $module_id
     * @param $numeric
     * @param $content
     * @param $parent_id
     * @param $is_reply
     *
     * @return mixed
     */
    public function create($uid, $module_id, $numeric, $content, $parent_id, $is_reply)
    {
        return self::$model->create([
            'id'          => create_numeric_id(),
            'account_uid' => $uid,
            'module_id'   => $module_id,
            'numeric'     => $numeric,
            'content'     => $content,
            'parent_id'   => $parent_id,
            'is_reply'    => $is_reply
        ]);
    }

    /**
     * first. 2020/2/1 10:16.
     *
     * @param $id
     *
     * @return mixed
     */
    public function first($id)
    {
        return self::$model->where('id', $id)->first();
    }

    /**
     * get_uid. 2020/2/1 10:27.
     *
     * @param $uid
     *
     * @return mixed
     */
    public function get_uid($uid)
    {
        return self::$model->where('account_uid', $uid)->paginate();
    }

    /**
     * module_numeric_get. 2020/2/1 10:44.
     *
     * @param $module_id
     * @param $numeric
     *
     * @return mixed
     */
    public function module_numeric_get($module_id, $numeric)
    {
        return self::$model->where('numeric', $numeric)->where('module_id', $module_id)->paginate();
    }

    /**
     * reply. 2020/2/1 11:09.
     *
     * @param $id
     *
     * @return mixed
     */
    public function reply($id)
    {
        return self::$model->where('parent_id', $id)->paginate();
    }

    /**
     * reply_count_increment. 2020/2/2 18:16.
     *
     * @param $id
     *
     * @return mixed
     */
    public function reply_count_increment($id)
    {
        $db = self::$model->where('id', $id)->first();
        if ($db) {
            $db->increment('reply_count');
        }
        return $db;
    }
}
