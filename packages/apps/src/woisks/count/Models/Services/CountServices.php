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

namespace Woisks\Count\Models\Services;

use Woisks\Count\Models\Repository\CountRepository;
use Woisks\Count\Models\Repository\LogRepository;
use Woisks\Dict\Models\Services\DictGetServices;
use Woisks\Jwt\Services\JwtService;

/**
 * Class CountServices.
 *
 * @package Woisks\Count\Models\Services
 *
 * @Author Maple Grove  <Woisks@126.com> 2020/2/2 11:09
 */
class CountServices
{
    /**
     * @var CountRepository
     */
    private $countRepo;
    /**
     * @var LogRepository
     */
    private $logRepo;

    /**
     * CountServices constructor. 2020/2/2 11:09.
     *
     * @param  CountRepository  $countRepo
     * @param  LogRepository  $logRepo
     *
     * @return void
     */
    public function __construct(CountRepository $countRepo, LogRepository $logRepo)
    {
        $this->countRepo = $countRepo;
        $this->logRepo   = $logRepo;
    }

    /**
     * change. 2020/2/2 14:21.
     *
     * @param $request
     *
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function change($request)
    {

        $module_db = DictGetServices::get($request->input('module'));
        if (!$module_db) {
            return res('count_create_module_error', '统计创建模块不合法');
        }

        $module_id = $module_db->id;

        $action_db = DictGetServices::get($request->input('action'));
        if (!$action_db) {
            return res('count_create_action_error', '统计创建模块不合法');
        }
        $action_id = $action_db->id;
        $uid       = JwtService::jwt_account_uid();
        $numeric   = $request->input('numeric');

        try {
            \DB::beginTransaction();
            $log_db = $this->logRepo->first($uid, $module_id, $action_id, $numeric);

            if (!$log_db) {
                //统计
                $count_db = $this->countRepo->increment($module_id, $action_id, $numeric);
                //创建记录
                $this->logRepo->create($uid, $module_id, $action_id, $numeric);
                \DB::commit();
                return res('success', '创建成功', $count_db);
            }
            $count_db = $this->countRepo->decrement($module_id, $action_id, $numeric);
            $log_db->delete();
            \DB::commit();
            return res('success', '取消成功', $count_db);

        } catch (\Throwable $e) {

            \DB::rollBack();
            return res('services_error', '服务器开小差了,请稍后再试');
        }


    }
}