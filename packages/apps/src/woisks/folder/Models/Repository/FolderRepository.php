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

namespace Woisks\Folder\Models\Repository;


use Woisks\Folder\Models\Entity\FolderEntity;

/**
 * Class FolderRepository.
 *
 * @package Woisks\Article\Models\Repository
 *
 * @Author Maple Forest  <Woisks@126.com> 2019/11/22 21:31
 */
class FolderRepository
{
    /**
     * @var FolderEntity
     */
    private static $model;

    /**
     * FolderRepository constructor. 2019/11/22 21:31.
     *
     * @param  FolderEntity  $folder
     *
     * @return void
     */
    public function __construct(FolderEntity $folder)
    {
        self::$model = $folder;
    }

    /**
     * create. 2019/11/22 21:33.
     *
     * @param $id
     * @param $uid
     * @param $module_id
     * @param $cover_photo_id
     * @param $title
     * @param $readme
     * @param $is_public
     *
     * @return mixed
     */
    public function create($id, $uid, $module_id, $cover_photo_id, $title, $readme, $is_public)
    {
        return self::$model->create([
            'id'             => $id,
            'account_uid'    => $uid,
            'module_id'      => $module_id,
            'cover_photo_id' => $cover_photo_id,
            'title'          => $title,
            'readme'         => $readme,
            'is_public'      => $is_public
        ]);
    }

    /**
     * first. 2020/1/30 12:37.
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
     * get_uid_module. 2019/11/22 21:34.
     *
     * @param $uid
     * @param $module_id
     *
     * @return mixed
     */
    public function get_uid_module($uid, $module_id)
    {
        return self::$model->where('account_uid', $uid)->where('module_id', $module_id)->get();
    }


    /**
     * get_uid_module_public. 2019/11/22 21:34.
     *
     * @param $uid
     * @param $module_id
     *
     * @return mixed
     */
    public function get_uid_module_public($uid, $module_id)
    {
        return self::$model->where('account_uid', $uid)->where('module_id', $module_id)->where('is_public',
            true)->get();
    }

    /**
     * get_uid_public. 2020/1/30 12:07.
     *
     * @param $uid
     *
     * @return mixed
     */
    public function get_uid_public($uid)
    {
        return self::$model->where('account_uid', $uid)->where('is_public', true)->get();
    }

    /**
     * get_uid_module_private. 2019/11/22 21:34.
     *
     * @param $uid
     * @param $module_id
     *
     * @return mixed
     */
    public function get_uid_module_private($uid, $module_id)
    {
        return self::$model->where('account_uid', $uid)->where('module_id', $module_id)->where('is_public',
            false)->get();
    }

    /**
     * get_uid. 2020/1/30 11:54.
     *
     * @param $uid
     *
     * @return mixed
     */
    public function get_uid($uid)
    {
        return self::$model->where('account_uid', $uid)->get();
    }

    /**
     * exists. 2020/2/1 11:45.
     *
     * @param $folder_id
     *
     * @return mixed
     */
    public function exists($folder_id)
    {
        return self::$model->where('id', $folder_id)->exists();
    }
}
