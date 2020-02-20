<?php

declare(strict_types=1);

/*
 * +----------------------------------------------------------------------+
 * |                   At all timesI love the moment                      |
 * +----------------------------------------------------------------------+
 * | Copyright (c) 2019 www.Woisk.com All rights reserved.                |
 * +----------------------------------------------------------------------+
 * |  Author:  Maple Grove  <Woisks@126.com>   QQ:364956690   286013629  |
 * +----------------------------------------------------------------------+
 */

namespace Woisks\User\Models\Services;

use Carbon\Carbon;
use Woisks\Jwt\Services\JwtService;
use Woisks\Photo\Models\Services\PhotoServices;
use Woisks\User\Models\Repository\InfoRepository;
use Woisks\User\Models\Repository\UserRepository;

/**
 * Class UserServices.
 *
 * @package Woisks\User\Models\Services
 *
 * @Author Maple Grove  <Woisks@126.com> 2020/1/31 13:47
 */
class UserServices
{
    /**
     * @var UserRepository
     */
    private $userRepo;
    /**
     * @var InfoRepository
     */
    private $infoRepo;

    /**
     * UserServices constructor. 2020/1/31 13:48.
     *
     * @param  UserRepository  $userRepo
     * @param  InfoRepository  $infoRepo
     *
     * @return void
     */
    public function __construct(UserRepository $userRepo, InfoRepository $infoRepo)
    {
        $this->userRepo = $userRepo;
        $this->infoRepo = $infoRepo;
    }

    /**
     * 创建用户信息
     * create. 2020/1/31 12:29.
     *
     * @param $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function create($request)
    {
        $db = $this->userRepo->first(JwtService::jwt_account_uid());
        if ($db) {
            return $this->update($request, $db);
        }
        $background = $request->input('background', 0);
        $avatar     = $request->input('avatar', 0);

        $name        = $request->input('name');
        $sign        = $request->input('sign', '');
        $gender      = $request->input('gender', 'm');
        $is_gender   = $request->input('is_gender', 1);
        $birthday    = $request->input('birthday', '');
        $is_birthday = $request->input('is_birthday', 1);
//        if ($background) {
//            if (!PhotoServices::exists($background)) {
//                return res('photo_not_exists', '图片不存在');
//            }
//        }
//
//        if ($avatar) {
//            if (!PhotoServices::exists($avatar)) {
//                return res('photo_not_exists', '图片不存在');
//            }
//        }
        $db = $this->userRepo->create(JwtService::jwt_account_uid(), $background, $avatar, $name, $gender, $is_gender,
            $birthday, $is_birthday,
            $sign);
        return $db ? res('success', '用户信息创建成功', $db) : res('user_info_error', '用户信息创建失败,请稍后再试');
    }

    public function services_create($account_uid, $name, $gender, $birthday)
    {
        $db = $this->userRepo->services_create($account_uid, $name, $gender, $birthday);

        return $db ? res('success', '用户信息创建成功', $db) : res('user_info_error', '用户信息创建失败,请稍后再试');
    }

    /**
     * 修改用户信息
     * update. 2020/1/31 12:29.
     *
     * @param $request
     * @param $db
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function update($request, $db)
    {
        //修改背景
        $background = $request->input('background') ?? $db->background_photo_id;
        //        if ($background) {
//            if (!PhotoServices::exists($background)) {
//                return res('photo_not_exists', '图片不存在');
//            }
        $db->background_photo_id = $background;
//        }


        //修改头像
        $avatar = $request->input('avatar') ?? $db->avatar_photo_id;
        //
//        if ($avatar) {
//            if (!PhotoServices::exists($avatar)) {
//                return res('photo_not_exists', '图片不存在');
//            }
        $db->avatar_photo_id = $avatar;

//        }

        //修改昵称
        $name = $request->input('name') ?? $db->name;
        if ($name != $db->name) {

            if (!(Carbon::now() >= Carbon::parse($db->name_last_time))) {
                return res('user_name_update_frequently', '用户昵称修改过于频繁');
            }
            $db->name               = $name;
            $name_update_time_month = config('woisk.user.name_update_time_month');
            $db->name_last_time     = Carbon::now()->addMonth($name_update_time_month)->timestamp;
        }


        //修改签名
        $sign     = $request->input('sign') ?? $db->sign;
        $db->sign = $sign;


        //修改性别
        $gender        = $request->input('gender') ?? $db->gender;
        $db->gender    = $gender;
        $is_gender     = $request->input('is_gender') ?? $db->is_gender;
        $db->is_gender = $is_gender;

        //修改年龄
        $birthday        = $request->input('birthday') ?? $db->birthday;
        $db->birthday    = $birthday;
        $is_birthday     = $request->input('is_birthday') ?? $db->is_birthday;
        $db->is_birthday = $is_birthday;

        return $db->save() ? res('success', '用户信息修改成功') : res('user_info_update_error', '用户信息修改失败,稍后再试');
    }

    /**
     * getUser. 2020/1/31 15:46.
     *
     * @param $account_uid
     * @param $param
     *
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function getUser($account_uid, $param)
    {
        $db = $this->userRepo->first($account_uid);
        if (!$db) {
            return res('user_not_exists', '用户信息不存在');
        }
        if ($param == 'card') {
            return res('success', '获取成功', $db);
        }

        if ($param == 'all') {
            $info_db = $this->infoRepo->get($account_uid);
            if ($info_db->isEmpty()) {
                return res('success', '获取成功', $db);
            }

            $info_data = [];
            foreach ($info_db as $key => $value) {
                $attribute_db = AttributeServices::first($value->attribute_id);
                if ($attribute_db) {
                    $value->alias                    = $attribute_db->alias;
                    $value->name                     = $attribute_db->name;
                    $value->count                    = $attribute_db->count;
                    $info_data[$attribute_db->alias] = $value;
                }

            }
            $db->info = $info_data;
            return res('success', '获取成功', $db);
        }

        return res('user_param_error', '用户信息类别错误');
    }


}