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


use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Throwable;
use Woisks\Agent\AgentService;
use Woisks\Jwt\JWT;
use Woisks\Jwt\Services\JwtService;
use Woisks\Passport\Events\PassportLogEvent;
use Woisks\Passport\Exceptions\DisableAccountException;
use Woisks\Passport\Exceptions\FreezeAccountException;
use Woisks\Passport\Exceptions\LockException;
use Woisks\Passport\Exceptions\PasswordErrorException;
use Woisks\Passport\Models\Repository\AccountRepository;
use Woisks\Passport\Models\Repository\LogRepository;
use Woisks\Passport\Models\Repository\PassportRepository;

/**
 * Class LoginServices.
 *
 * @package Woisks\Passport\Models\Services
 *
 * @Author Maple Grove  <Woisks@126.com> 2020/1/29 19:54
 */
class LoginServices
{
    /**
     * @var LogRepository
     */
    private $logRepo;

    /**
     * @var AccountRepository
     */
    private $accountRepo;

    /**
     * @var PassportRepository
     */
    private $passportRepo;

    /**
     * LoginServices constructor. 2020/1/29 19:54.
     *
     * @param  PassportRepository  $passportRepo
     * @param  AccountRepository  $accountRepo
     * @param  LogRepository  $logRepo
     *
     * @return void
     */
    public function __construct(
        PassportRepository $passportRepo,
        AccountRepository $accountRepo,
        LogRepository $logRepo
    ) {
        $this->logRepo      = $logRepo;
        $this->accountRepo  = $accountRepo;
        $this->passportRepo = $passportRepo;
    }


    /**
     * login. 2020/1/29 19:54.
     *
     * @param $request
     *
     * @return JsonResponse|null
     */
    public function login($request)
    {
        //检测账号是否存在
        if (!$this->passportRepo->usernameExists($request->input('username'))) {
            return res('passport_login_username_not_exists', '账号不存在');
        }

        try {
            //开启数据库事务
            DB::beginTransaction();

            $passport = $this->passportRepo->usernameFirst($request->input('username'));
            $account  = $this->accountRepo->uidFind($passport->account_uid);

            $this->checkPassword($request->input('password'), $account, $passport);


            if (!is_null($this->checkLimitLoginTime($account))) {
                return $this->checkLimitLoginTime($account);
            }

            $this->checkStatus($account, $passport);

            $res = $this->loginStatus($passport, $account);

        } catch (LockException $e) {
            $res = res('passport_login_passport_lock', '密码错误次数过多,账号锁定30分钟');
        } catch (PasswordErrorException $e) {
            $res = res('passport_login_password_error', '密码错误');
        } catch (DisableAccountException $e) {
            $res = res('passport_login_passport_disable', '账号已禁用');
        } catch (FreezeAccountException $e) {
            $res = res('passport_login_passport_freeze', '账号已冻结');
        } catch (Throwable $e) {
            DB::rollBack();
            $res = res('services_error', '服务器开小差了,请稍后再试');
        }
        DB::commit();

        return $res;
    }


    /**
     * checkPassword. 2019/7/28 11:47.
     *
     * @param  string  $password
     * @param $account
     * @param $passport
     *
     * @return void
     * @throws LockException
     * @throws PasswordErrorException
     */
    public function checkPassword(string $password, $account, $passport)
    {
        $password = Hash::check($password, $account->password);
        if (!$password) {

            if ($account->login_error_count >= config('woisk.passport.login_error_numeric')) {

                $this->event('fail', create_numeric_id(), $passport->account_uid, $passport->account_type);
                $account->login_error_count++;
                $minute                    = config('woisk.passport.limit_login_time_minute');
                $account->limit_login_time = Carbon::now()->addMinute($minute)->timestamp;
                $account->save();

                throw new LockException('密码错误次数太多，锁定30分钟');
            }

            $this->event('fail', create_numeric_id(), $passport->account_uid, $passport->account_type);
            $account->login_error_count++;
            $account->save();

            throw new PasswordErrorException('密码错误');
        }
    }


    /**
     * checkLimitLoginTime. 2019/7/28 11:47.
     *
     * @param $account
     *
     * @return JsonResponse|null
     */
    private function checkLimitLoginTime($account)
    {
        if ($account->limit_login_time >= Carbon::now()->timestamp) {
            //验证限制登录时间
            $time = Carbon::parse($account->limit_login_time)->diffInMinutes();

            $account->login_error_count++;//登录错误次数加加
            $account->save();

            return res('passport_login_lock', '账号已锁定,请于'.$time.'分钟后,再次登录');
        }

        return null;
    }


    /**
     * checkStatus. 2019/7/28 11:47.
     *
     * @param $account
     * @param $passport
     *
     * @return void
     * @throws DisableAccountException
     * @throws FreezeAccountException
     */
    private function checkStatus($account, $passport)
    {

        if ($account->status == config('woisk.passport.disable')) {
            //注销账号
            throw new DisableAccountException('帐户已禁用');
        }

        if ($account->status == config('woisk.passport.freeze')) {
            //冻结账号
            throw new FreezeAccountException('账户已冻结');
        }

        $account->login_error_count       = 0;  //清零密码错误次数
        $account->last_login_account_type = $passport->account_type;
        $account->sum_login_count++;
        $account->save();

        $passport->login_count++;//账号登录次数累加
        $passport->save();

        $this->logRepo->loginFail_delete($account->id);

    }


    /**
     * loginStatus. 2019/7/28 11:47.
     *
     * @param $passport
     * @param $account
     *
     * @return JsonResponse
     */
    private function loginStatus($passport, $account)
    {
        $loginID = create_numeric_id();

        $this->event('login', $loginID, $passport->account_uid, $passport->account_type);

        $mac                = Carbon::now()->timestamp;
        $expire_time_second = config('woisk.jwt.expire_time') * 60;
        $redis              = \Redis::setex('token:'.$account->id.':'.$mac, $expire_time_second, $loginID);

        return $redis
            ? res('success', '登录成功', [
                'token'              => $this->token($passport->account_uid, $loginID, $mac),
                'account_uid'        => "$passport->account_uid",
                'expire_time_second' => $expire_time_second
            ])
            : res('passport_login_error', '登录失败,请稍后再试');

    }


    /**
     * token. 2019/7/27 1:21.
     *
     * @param  int  $uid
     * @param  int  $loginID
     * @param  int  $mac
     *
     * @return mixed
     */
    private function token(int $uid, int $loginID, int $mac)
    {
        return JWT::encode_jwt([
            'ide' => $uid,//用户UID
            'iva' => $loginID,//登录日志记录ID
            'mac' => $mac,//mac用户唯一识别ID
        ], JwtService::jwt_secret_key());

    }

    /**
     * event. 2019/7/27 1:21.
     *
     * @param $type
     * @param $logID
     * @param $account_uid
     * @param $account_type
     *
     * @return void
     */
    private function event($type, $logID, $account_uid, $account_type)
    {
        $agent = AgentService::info();
        event(new PassportLogEvent($type, $logID, $account_uid, $account_type, request()->getClientIp(),
            $agent['os'], $agent['client'], $agent['brand_model'], $agent['device']));
    }

}