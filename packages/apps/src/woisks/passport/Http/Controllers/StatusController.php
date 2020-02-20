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

namespace Woisks\Passport\Http\Controllers;


use Arr;
use Illuminate\Http\JsonResponse;
use Woisks\Jwt\Services\JwtService;
use Woisks\Passport\Models\Entity\LoginLogEntity;

/**
 * Class StatusController
 *
 * @package Woisks\PassportEntity\Http\Controllers
 *
 * @Author  Maple Grove  <bolelin@126.com> 2019/6/8 0:56
 */
class StatusController extends BaseController
{
    /**
     * online 2019/6/8 0:56
     *
     *
     * @return JsonResponse
     */
    public function online()
    {
        $info          = JwtService::jwt_token_info();
        $redis_collect = \Redis::keys('token:' . $info['ide'] . '*');

        $prefix = config('database.redis.options.prefix');

        $_mac = $prefix . 'token:' . $info['ide'] . ':';

        $mac    = [];
        $log_id = [];
        foreach ($redis_collect as $item) {
            $mac[]    = preg_replace("/$_mac/", "", $item);
            $log_id[] = \Redis::get(preg_replace("/$prefix/", "", $item));
        }

        $db = LoginLogEntity::find($log_id);

        $data = [];
        foreach ($db as $key => $value) {
            if ($mac[$key] == $info['mac']) {

                $data[$mac[$key]] = Arr::add($value, 'current', true);
            }
            $data[$mac[$key]] = $value;
        }

        return res('success', '获取成功', true, ['count' => count($redis_collect), 'online' => $data]);


    }

    /**
     * offline. 2019/11/19 8:38.
     *
     * @param $mac
     *
     * @return JsonResponse
     */
    public function offline($mac)
    {
        if (strlen($mac) != 10 && strlen($mac) != 11) {
            return res('passport_offline_mac_error', '参数不正确 ');
        }

        $info          = JwtService::jwt_token_info();
        $redis_collect = \Redis::keys('token:' . $info['ide'] . '*');

        $prefix = config('database.redis.options.prefix') . 'token:' . $info['ide'] . ':';

        $macs = [];
        foreach ($redis_collect as $item) {
            $macs[] = preg_replace("/$prefix/", "", $item);
        }

        if (!Arr::has(array_flip($macs), $mac)) {
            return res('passport_offline_mac_error', '参数不正确 ');
        }

        $del = \Redis::del('token:' . $info['ide'] . ':' . $mac);

        return $del ? res('success', '离线成功') : res('services_error', '服务器开小差了,请稍后再试');

    }
}
