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


use Woisks\Jwt\Services\JwtService;

/**
 * Class LogoutServices.
 *
 * @package Woisks\Passport\Models\Services
 *
 * @Author Maple Grove  <Woisks@126.com> 2020/1/29 18:04
 */
class LogoutServices
{
    /**
     * logout. 2020/1/29 18:04.
     *
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        $info = JwtService::jwt_token_info();
        \Redis::del('token:'.$info['ide'].':'.$info['mac']);

        return res('success', '退出登录成功');
    }
}