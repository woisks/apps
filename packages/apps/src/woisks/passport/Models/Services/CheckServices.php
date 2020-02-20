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

use Illuminate\Http\JsonResponse;
use Woisks\Passport\Models\Repository\PassportRepository;

/**
 * Class CheckServices.
 *
 * @package Woisks\Passport\Models\Services
 *
 * @Author Maple Forest  <Woisks@126.com> 2020/1/29 12:28
 */
class CheckServices
{

    /**
     * @var PassportRepository
     */
    private $passportRepo;

    /**
     * CheckServices constructor. 2020/1/29 12:28.
     *
     * @param  PassportRepository  $passportRepo
     *
     * @return void
     */
    public function __construct(PassportRepository $passportRepo)
    {
        $this->passportRepo = $passportRepo;
    }


    /**
     * register. 2019/7/26 22:35.
     *
     * @param  string  $username
     *
     * @return JsonResponse
     */
    public function register(string $username)
    {
        if (!is_email($username) && !is_phone($username)) {
            return res('passport_check_register_username_error', '账号必须为合法电子邮箱地址或手机号码');
        }

        return $this->passportRepo->usernameExists($username)
            ? res('passport_check_register_username_exists', '账号已存在')
            : res('success', '账号可以使用,欢迎加入');
    }


    /**
     * login 2019/5/10 11:25
     *
     * @param  string  $username
     *
     * @return JsonResponse
     */
    public function login(string $username)
    {
        $db = $this->passportRepo->usernameFirst($username);
        if (!$db) {
            return res('passport_check_login_username_not_exists', '账号不存在');
        }

        return res('success', '账号正常');
    }


    /**
     * passport 2019/5/10 11:25
     *
     * @param  string  $username
     *
     * @return JsonResponse
     */
    public function passport(string $username)
    {
        return $this->passportRepo->usernameExists($username)
            ? res('passport_check_passport_exists', '账号已存在')
            : res('success', '可以使用');
    }

}