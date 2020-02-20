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


use Woisks\Count\Models\Repository\LogRepository;
use Woisks\Dict\Models\Services\DictGetServices;

/**
 * Class LogServices.
 *
 * @package Woisks\Count\Models\Services
 *
 * @Author Maple Grove  <Woisks@126.com> 2020/2/2 11:09
 */
class LogServices
{
    /**
     * @var LogRepository
     */
    private $logRepo;

    /**
     * LogServices constructor. 2020/2/2 11:09.
     *
     * @param  LogRepository  $logRepo
     *
     * @return void
     */
    public function __construct(LogRepository $logRepo)
    {
        $this->logRepo = $logRepo;
    }

    /**
     * get. 2020/2/2 16:14.
     *
     * @param $numeric
     * @param $module
     * @param $action
     *
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function get($numeric, $module, $action)
    {
        $len = strlen($numeric);
        if ((!$len == 18) && !($len == 19)) {
            return res('count_numeric_error', '统计ID不合法 ');
        }

        if ($action == 'all') {
            return $this->get_all($numeric, $module);
        }

        $module_db = DictGetServices::get($module);
        if (!$module_db) {
            return res('count_module_error_get', '统计模块不合法');
        }
        $module_id = $module_db->id;


        $action_db = DictGetServices::get($action);
        if (!$action_db) {
            return res('count_action_error', '统计动作不合法');
        }
        $action_id = $action_db->id;

        $db = $this->logRepo->numeric_module_action_get($numeric, $module_id, $action_id);
        if ($db->isEmpty()) {
            return res('count_log_not_exists', '统计记录不存在');
        }
        return res('success', '获取成功', $db);
    }

    /**
     * get_all. 2020/2/2 16:14.
     *
     * @param $numeric
     * @param $module
     *
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    private function get_all($numeric, $module)
    {
        $module_db = DictGetServices::get($module);
        if (!$module_db) {
            return res('count_module_error_all', '统计模块不合法');
        }
        $module_id = $module_db->id;

        $db = $this->logRepo->numeric_module($numeric, $module_id);
        return $db ? res('success', '获取成功', $db) : res('count_log_not_exists', '统计记录不存在');
    }

    /**
     * user_get. 2020/2/2 16:27.
     *
     * @param $uid
     * @param $module
     * @param $action
     *
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function user_get($uid, $module, $action)
    {
        $len = strlen($uid);
        if ((!$len == 18) && !($len == 19)) {
            return res('count_id_error', '统计ID不合法 ');
        }

        if ($action == 'all') {
            return $this->user_get_all($uid, $module);
        }

        $module_db = DictGetServices::get($module);
        if (!$module_db) {
            return res('count_module_error_get', '统计模块不合法');
        }
        $module_id = $module_db->id;


        $action_db = DictGetServices::get($action);
        if (!$action_db) {
            return res('count_action_error', '统计动作不合法');
        }
        $action_id = $action_db->id;

        $db = $this->logRepo->uid_module_action_get($uid, $module_id, $action_id);
        if ($db->isEmpty()) {
            return res('count_log_not_exists', '统计记录不存在');
        }
        return res('success', '获取成功', $db);
    }

    /**
     * user_get_all. 2020/2/2 16:27.
     *
     * @param $uid
     * @param $module
     *
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    private function user_get_all($uid, $module)
    {
        $module_db = DictGetServices::get($module);
        if (!$module_db) {
            return res('count_module_error_get_all', '统计模块不合法');
        }
        $module_id = $module_db->id;

        $db = $this->logRepo->uid_module_get($uid, $module_id);
        if ($db->isEmpty()) {
            return res('count_log_not_exists', '统计记录不存在');
        }
        return res('success', '获取成功', $db);
    }
}