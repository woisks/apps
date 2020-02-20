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

namespace Woisks\Count\Http\Controllers;


use Woisks\Count\Models\Services\LogServices;

/**
 * Class LogController.
 *
 * @package Woisks\Count\Http\Controllers
 *
 * @Author Maple Grove  <Woisks@126.com> 2020/2/2 16:13
 */
class LogController extends BaseController
{
    /**
     * @var LogServices
     */
    private $logServices;

    /**
     * LogController constructor. 2020/2/2 16:13.
     *
     * @param  LogServices  $logServices
     *
     * @return void
     */
    public function __construct(LogServices $logServices)
    {
        $this->logServices = $logServices;
    }

    /**
     * get. 2020/2/2 16:17.
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
        return $this->logServices->get($numeric, $module, $action);
    }

    public function user_get($uid, $module, $action)
    {
        return $this->logServices->user_get($uid, $module, $action);
    }
}
