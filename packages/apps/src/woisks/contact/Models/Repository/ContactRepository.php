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

namespace Woisks\Contact\Models\Repository;


use Woisks\Contact\Models\Entity\ContactEntity;

/**
 * Class ContactRepository.
 *
 * @package Woisks\Contact\Models\Repository
 *
 * @Author Maple Grove  <Woisks@126.com> 2020/2/1 12:03
 */
class ContactRepository
{
    /**
     * @var ContactEntity
     */
    private static $model;

    /**
     * ContactRepository constructor. 2020/2/1 12:03.
     *
     * @param  ContactEntity  $contact
     *
     * @return void
     */
    public function __construct(ContactEntity $contact)
    {
        self::$model = $contact;
    }

    /**
     * create. 2020/2/1 12:03.
     *
     * @param $uid
     * @param $folder_id
     * @param $isp_id
     * @param $passport
     * @param $title
     * @param $readme
     *
     * @return void
     */
    public function create($uid, $folder_id, $isp_id, $qrcode_id, $passport, $title, $readme)
    {
        return self::$model->create([
            'id'              => create_numeric_id(),
            'account_uid'     => $uid,
            'folder_id'       => $folder_id,
            'isp_id'          => $isp_id,
            'passport'        => $passport,
            'qrcode_photo_id' => $qrcode_id,
            'title'           => $title,
            'readme'          => $readme
        ]);
    }

    /**
     * folder_get. 2020/2/1 17:54.
     *
     * @param $folder_id
     *
     * @return mixed
     */
    public function folder_get($folder_id)
    {
        return self::$model->where('folder_id', $folder_id)->get();
    }

    /**
     * first. 2020/2/1 18:19.
     *
     * @param $id
     *
     * @return mixed
     */
    public function first($id)
    {
        return self::$model->where('id', $id)->first();
    }
}
