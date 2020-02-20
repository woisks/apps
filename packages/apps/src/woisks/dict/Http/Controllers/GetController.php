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

namespace Woisks\Dict\Http\Controllers;


use Woisks\Dict\Http\Requests\GetRequest;
use Woisks\Dict\Models\Services\DictGetServices;

/**
 * Class GetController.
 *
 * @package Woisks\Dict\Http\Controllers
 *
 * @Author Maple Forest  <Woisks@126.com> 2020/1/23 14:41
 */
class GetController extends BaseController
{
    /**
     * @var DictGetServices
     */
    private $getServices;

    /**
     * GetController constructor. 2020/1/23 14:41.
     *
     * @param  DictGetServices  $getServices
     *
     * @return void
     */
    public function __construct(DictGetServices $getServices)
    {
        $this->getServices = $getServices;
    }

    /**
     * first. 2020/1/23 14:43.
     *
     * @param  GetRequest  $request
     *
     * @return mixed
     */
    public function first(GetRequest $request)
    {
        $alias = $request->input('alias');
        $db    = $this->getServices->first($alias);
        return $db ? res('success', '获取成功', $db) : res('dict_not_exists', '词典信息不存在');
    }
}