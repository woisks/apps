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
use Illuminate\Support\Facades\Hash;
use Woisks\Jwt\Services\JwtService;
use Woisks\Passport\Models\Repository\AccountRepository;
use Woisks\Passport\Models\Repository\PassportRepository;

/**
 * Class PasswordServices.
 *
 * @package Woisks\Passport\Models\Services
 *
 * @Author Maple Grove  <Woisks@126.com> 2020/1/29 20:27
 */
class PasswordServices
{
    /**
     * accountRepo.  2019/7/28 11:49.
     *
     * @var  AccountRepository
     */
    public $accountRepo;

    /**
     * passportRepo.  2019/7/28 11:49.
     *
     * @var  PassportRepository
     */
    public $passportRepo;

    /**
     * PasswordController constructor. 2019/7/28 11:49.
     *
     * @param  AccountRepository  $accountRepository
     * @param  PassportRepository  $passportRepository
     *
     * @return void
     */
    public function __construct(AccountRepository $accountRepository, PassportRepository $passportRepository)
    {
        $this->accountRepo  = $accountRepository;
        $this->passportRepo = $passportRepository;
    }


    /**
     * update. 2020/1/29 20:27.
     *
     * @param $request
     *
     * @return JsonResponse
     */
    public function update($request)
    {
        $old_password = $request->input('old_password');
        $new_password = $request->input('password');

        $info    = JwtService::jwt_token_info();
        $account = $this->accountRepo->uidFind($info['ide']);

        if ($old_password == $new_password) {
            return res('passport_password_newPassword_and_oldPassword_equal', '新密码不能和旧密码相同');
        }

        $bool = Hash::check($old_password, $account->password);

        if ($bool) {
            $account->update(['password' => bcrypt($new_password)]);

            $this->offline_all($info['ide']);

            return res('success', '密码更新成功');
        }

        return res('passport_password_oldPassword_error', '旧密码不正确');
    }


    /**
     * reset. 2020/1/29 20:27.
     *
     * @param $request
     *
     * @return JsonResponse
     */
    public function reset($request)
    {
        $username = $request->input('username');
        $password = $request->input('password');

        $passport = $this->passportRepo->usernameFirst($username);
        $account  = $this->accountRepo->uidFind($passport->account_uid);
        $bool     = $account->update(['password' => bcrypt($password)]);
        $this->offline_all($passport->account_uid);

        return $bool ? res('success', '密码重设成功') : res('services_error', '服务器开小差了,请稍后再试');
    }


    /**
     * offline_all 2019/6/7 22:36
     * 更新密码 所有账号全部下线,重新登录
     *
     * @param  int  $uid
     *
     * @return void
     */
    private function offline_all(int $uid): void
    {
        $collect = \Redis::keys('token:'.$uid.'*');
        $prefix  = config('database.redis.options.prefix');
        foreach ($collect as $item) {
            \Redis::del(preg_replace("/$prefix/", "", $item));
        }
    }

}