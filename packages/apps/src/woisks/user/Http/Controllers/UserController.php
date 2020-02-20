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

namespace Woisks\User\Http\Controllers;


use Woisks\User\Http\Requests\CreateRequest;
use Woisks\User\Models\Services\UserServices;

/**
 * Class UserController.
 *
 * @package Woisks\User\Http\Controllers
 *
 * @Author Maple Grove  <Woisks@126.com> 2020/1/31 11:23
 */
class UserController extends BaseController
{

    /**
     * @var UserServices
     */
    private $userServices;

    /**
     * UserController constructor. 2020/1/31 11:23.
     *
     * @param  UserServices  $userServices
     *
     * @return void
     */
    public function __construct(UserServices $userServices)
    {
        $this->userServices = $userServices;
    }


    public function create(CreateRequest $request)
    {
        return $this->userServices->create($request);

    }

    /**
     * setName. 2019/11/21 13:05.
     *
     * @param $name
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function setName($name)
    {
        $len = strlen($name);
        if ($len > 15 || $len < 2) {
            return res('user_name_error', '昵称不符合规则');
        }

        $db = $this->userRepo->first(JwtService::jwt_account_uid());
        if (!$db) {
            return res('user_not_exists', '用户不存在');
        }

        //效验修改昵称的时间-三个月修改一次
        if (Carbon::now() >= Carbon::parse($db->name_last_time)) {
            $db->name               = $name;
            $name_update_time_month = config('woisk.user.name_update_time_month');
            $db->name_last_time     = Carbon::now()->addMonth($name_update_time_month)->timestamp;
            return $db->save() ? res('success', '修改成功', true) : res('services_error', '服务器开小差了,请稍后再试');
        }

        return res('user_setName_too_frequent', '昵称更新过于频繁,3个月内只能修改一次');
    }


    /**
     * avatar. 2019/11/21 13:05.
     *
     * @param $photo_id
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function avatar($photo_id)
    {
        //效验图片合法性
        if (PhotoServices::exists($photo_id)) {

            //验证用户信息是否存在
            $db = $this->userRepo->first(JwtService::jwt_account_uid());
            if (!$db) {
                return res('user_not_exists', '用户不存在');
            }
            $db->avatar_photo_id = $photo_id;
            return $db->save() ? res('success', '修改成功') : res('services_error', '服务器开小差了,请稍后再试');
        }

        return res('user_avatar_photo_error', '图片不存在');
    }

    /**
     * background. 2019/11/21 13:05.
     *
     * @param $photo_id
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function background($photo_id)
    {
        //效验图片合法性
        if (PhotoServices::exists($photo_id)) {

            //验证用户信息是否存在
            $db = $this->userRepo->first(JwtService::jwt_account_uid());
            if (!$db) {
                return res('user_not_exists', '用户不存在');
            }
            $db->background_photo_id = $photo_id;
            return $db->save() ? res('success', '修改成功') : res('services_error', '服务器开小差了,请稍后再试');
        }

        return res('user_background_photo_error', '图片不存在');
    }

    /**
     * sign. 2019/11/21 13:16.
     *
     * @param  SignRequest  $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function sign(SignRequest $request)
    {
        $sign = $request->input('sign');

        $db = $this->userRepo->first(JwtService::jwt_account_uid());
        if (!$db) {
            return res('user_not_exists', '用户不存在');
        }
        $db->sign = $sign;
        if ($db->save()) {
            return res('success', '修改成功', true);
        }
        return res('services_error', '服务器开小差了,请稍后再试');
    }

    /**
     * getUser. 2019/11/21 13:30.
     *
     * @param $account_uid
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getUser($account_uid)
    {
        $db = $this->userRepo->first($account_uid);
        if (!$db) {
            return res('user_info_not_exists', '用户信息不存在');
        }

        $db->avatar     = PhotoServices::transUrl($db->avatar_photo_id, 'avatar');
        $db->background = PhotoServices::transUrl($db->background_photo_id, 'background');

        return res('success', '获取用户信息成功', true, collect($db)->except(['id', 'background_photo_id', 'avatar_photo_id']));

    }
}
