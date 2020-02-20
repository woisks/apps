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

namespace Woisks\User\Models\Repository;


use Carbon\Carbon;
use Woisks\User\Models\Entity\UserEntity;


class UserRepository
{

    /**
     * model.  2019/7/28 16:47.
     *
     * @var static CardEntity
     */
    private static $model;


    /**
     * CardRepository constructor. 2019/7/28 16:47.
     *
     * @param  UserEntity  $user
     *
     * @return void
     */
    public function __construct(UserEntity $user)
    {
        self::$model = $user;
    }


    /**
     * first. 2019/7/28 16:47.
     *
     * @param $account_uid
     *
     * @return mixed
     */
    public function first($account_uid)
    {
        return self::$model->where('account_uid', $account_uid)->first();
    }

    /**
     * create. 2020/1/31 12:30.
     *
     * @param $account_uid
     * @param $background
     * @param $avatar
     * @param $name
     * @param $gender
     * @param $is_gender
     * @param $birthday
     * @param $is_birthday
     * @param $sign
     *
     * @return mixed
     */
    public function create(
        $account_uid,
        $background,
        $avatar,
        $name,
        $gender,
        $is_gender,
        $birthday,
        $is_birthday,
        $sign
    ) {
        return self::$model->create([
            'id'                  => create_numeric_id(),
            'account_uid'         => $account_uid,
            'background_photo_id' => $background,
            'avatar_photo_id'     => $avatar,
            'name'                => $name,
            'name_last_time'      => Carbon::now()->timestamp,
            'sign'                => $sign,
            'gender'              => $gender,
            'is_gender'           => $is_gender,
            'birthday'            => $birthday,
            'is_birthday'         => $is_birthday
        ]);
    }

    public function services_create($account_uid, $name, $gender, $birthday)
    {
        return self::$model->create([
            'id'                  => create_numeric_id(),
            'account_uid'         => $account_uid,
            'background_photo_id' => 0,
            'avatar_photo_id'     => 0,
            'name'                => $name,
            'name_last_time'      => Carbon::now()->timestamp,
            'sign'                => '',
            'gender'              => $gender,
            'is_gender'           => 1,
            'birthday'            => $birthday,
            'is_birthday'         => 1
        ]);
    }

}
