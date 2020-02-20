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

namespace Woisks\Media\Models\Repository;


use Woisks\Media\Models\Entity\PhotoEntity;


/**
 * Class PhotoRepository.
 *
 * @package Woisks\Media\Models\Repository
 *
 * @Author Maple Grove  <Woisks@126.com> 2020/2/3 11:38
 */
class PhotoRepository
{

    /**
     * @var PhotoEntity
     */
    private static $model;


    /**
     * PhotoRepository constructor. 2020/2/3 11:38.
     *
     * @param  PhotoEntity  $Media
     *
     * @return void
     */
    public function __construct(PhotoEntity $Media)
    {
        self::$model = $Media;
    }


    /**
     * created. 2020/2/3 11:38.
     *
     * @param $account_uid
     * @param $id
     * @param $module_id
     * @param $folder
     * @param $title
     * @param $readme
     * @param $is_comment
     *
     * @return mixed
     */
    public function created($account_uid, $id, $module_id, $folder, $title, $readme, $is_comment)
    {
        return self::$model->create([
            'id'          => $id,
            'account_uid' => $account_uid,
            'module_id'   => $module_id,
            'folder_id'   => $folder,
            'title'       => $title,
            'readme'      => $readme,
            'is_comment'  => $is_comment
        ]);

    }


}
