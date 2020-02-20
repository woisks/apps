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

namespace Woisks\Passport\Models\Services;


use Illuminate\Http\JsonResponse;
use Woisks\Jwt\Services\JwtService;
use Woisks\Passport\Models\Repository\PassportRepository;
use Woisks\Passport\Models\Repository\TypeCountRepository;

class PassportServices
{
    /**
     * passportRepo.  2019/7/28 11:49.
     *
     * @var  PassportRepository
     */
    private $passportRepo;

    /**
     * typeCountRepo.  2019/7/28 11:49.
     *
     * @var  TypeCountRepository
     */
    private $typeCountRepo;


    /**
     * PassportController constructor. 2019/7/28 11:49.
     *
     * @param  PassportRepository  $passportRepo
     * @param  TypeCountRepository  $typeCountRepo
     *
     * @return void
     */
    public function __construct(PassportRepository $passportRepo, TypeCountRepository $typeCountRepo)
    {
        $this->typeCountRepo = $typeCountRepo;
        $this->passportRepo  = $passportRepo;
    }


    /**
     * get. 2019/7/28 11:49.
     * 获取用户账号列表
     *
     * @return JsonResponse
     */
    public function get()
    {
        $db = $this->passportRepo->uidGet(JwtService::jwt_token_info()['ide'])->filter(function ($value) {
            if ($value->account_type == 'phone' || $value->account_type == 'email') {
                return $value->username = is_username_nonce($value->username);
            }

            return $value->username;
        });

        $data = [];
        foreach ($db as $item) {
            $data[$item->account_type] = $item;
//            if ($item->account_type == 'phone' || $item->account_type == 'email') {
//                $data['bind'][$item->account_type] = $item;
//
//            }
//            if ($item->account_type == 'numeric' || $item->account_type == 'username') {
//                $data['alias'][$item->account_type] = $item;
//            }
        }

        return res('success', '获取成功', $data);
    }


    public function add($request)
    {
        $username = $request->input('username');
        if ($this->passportRepo->usernameExists($username)) {
            return res('passport_add_passport_exists', '账号已存在');
        }

        $info         = JwtService::jwt_token_info();
        $account_type = account_type($username);

        $exists = $this->passportRepo->uidTypeExists($info['ide'], $account_type);
        if ($exists) {
            return res('passport_add_passport_type_exists', '每个账号类型只能设定一个');
        }

        $this->passportRepo->created($info['ide'], $username, $account_type);
        $this->typeCountRepo->typeIncrement($account_type);

        return res('success', '添加成功');
    }


    public function del($request)
    {
        $username = $request->input('username');

        if (!$this->passportRepo->usernameExists($username)) {
            return res('passport_del_username_not_exists', '账号不存在');
        }

        $info         = JwtService::jwt_token_info();
        $account_type = account_type($username);

        $passport = $this->passportRepo->usernameFirst($username);

        if (!$passport) {
            return res('passport_del_passport_type_not_exists', '账号类型不存在');
        }

        if ($info['ide'] == $passport->account_uid) {
            $passport->delete();
            $this->typeCountRepo->typeDecrement($account_type);

            return res('success', '删除成功');
        }

        return res('passport_del_passport_type_not_exists', '账号类型不存在');
    }


    public function bind($request)
    {
        $username = $request->input('username');

        if ($this->passportRepo->usernameExists($username)) {
            return res('passport_bind_username_exists', '账号已存在');
        }

        $info         = JwtService::jwt_token_info();
        $account_type = account_type($username);

        $exists = $this->passportRepo->uidTypeExists($info['ide'], $account_type);

        if ($exists) {
            return res('passport_bind_username_exists', '每个账号类型只能设定一个');
        }

        $this->passportRepo->created($info['ide'], $username, $account_type);
        $this->typeCountRepo->typeIncrement($account_type);

        return res('success', '绑定成功', true);
    }


    public function update($request)
    {
        $username = $request->input('username');
        if ($this->passportRepo->usernameExists($username)) {
            return res('passport_update_passport_username_exists', '账号已存在');
        }

        $info         = JwtService::jwt_token_info();
        $account_type = account_type($username);

        $exists = $this->passportRepo->uidTypeExists($info['ide'], $account_type);

        if (!$exists) {
            return res('passport_update_passport_type_not_exists', '该类型的账号不存在');
        }

        $bool = $this->passportRepo->updated($info['ide'], $account_type, $username);

        return $bool
            ? res('success', '更新成功')
            : res('services_error', '服务器开小差了,请稍后再试');
    }

}