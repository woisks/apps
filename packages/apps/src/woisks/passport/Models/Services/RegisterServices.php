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

namespace Woisks\Passport\Models\Services;


use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Throwable;
use Woisks\Agent\AgentService;
use Woisks\Passport\Events\PassportLogEvent;
use Woisks\Passport\Models\Repository\AccountRepository;
use Woisks\Passport\Models\Repository\PassportRepository;
use Woisks\User\Models\Services\UserServices;


/**
 * Class RegisterServices.
 *
 * @package Woisks\Passport\Models\Services
 *
 * @Author Maple Grove  <Woisks@126.com> 2020/1/29 13:15
 */
class RegisterServices
{

    /**
     * RegisterServices constructor. 2020/1/29 13:02.
     *
     * @param  AccountRepository  $accountRepo
     * @param  PassportRepository  $passportRepo
     *
     * @return void
     */
    public function __construct(AccountRepository $accountRepo, PassportRepository $passportRepo)
    {
        $this->accountRepo  = $accountRepo;
        $this->passportRepo = $passportRepo;
    }


    /**
     * services. 2020/1/29 13:15.
     *
     * @param $request
     * @param $username
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function services($request, $username)
    {
        if ($this->passportRepo->usernameExists($username)) {
            return res('passport_register_username_exists', '账号已存在');
        }

        try {
            DB::beginTransaction();

            $uid           = create_numeric_uid();
            $hash_password = Hash::make($request->input('password'));
            $account_type  = account_type($username);

            $this->accountRepo->initAccount($uid, $hash_password);
            $this->passportRepo->created($uid, $username, $account_type);

            TypeCountServices::increment($account_type);
            TypeCountServices::user_add();
            $name     = $request->input('name');
            $birthday = $request->input('birthday');
            $gender   = $request->input('gender');

            //创建用户信息
            $user = app()->make(UserServices::class)->services_create($uid, $name, $gender, $birthday);

            $agent = AgentService::info();
            event(new PassportLogEvent('register', create_numeric_id(), $uid, $account_type, request()->getClientIp(),
                $agent['os'], $agent['client'], $agent['brand_model'], $agent['device']));

        } catch (Throwable   $e) {

            DB::rollback();
            return res('services_error', '服务器开小差了,请稍后再试');
        }
        DB::commit();
        
        return res('success', '注册成功');
    }
}