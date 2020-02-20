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


use Woisks\Dict\Http\Requests\CreateRequest;
use Woisks\Dict\Models\Services\DictCreateServices;

/**
 * Class CreateController.
 *
 * @package Woisks\Dict\Http\Controllers
 *
 * @Author Maple Forest  <Woisks@126.com> 2020/1/23 14:33
 */
class CreateController extends BaseController
{
    /**
     * @var DictCreateServices
     */
    private $createServices;

    /**
     * CreateController constructor. 2020/1/23 14:33.
     *
     * @param  DictCreateServices  $createServices
     *
     * @return void
     */
    public function __construct(DictCreateServices $createServices)
    {
        $this->createServices = $createServices;
    }

    /**
     * create. 2020/1/23 14:33.
     *
     * @param  CreateRequest  $request
     *
     * @return mixed
     */
    public function create(CreateRequest $request)
    {
        $alias = $request->input('alias');
        $name  = $request->input('name');
        $db    = $this->createServices->create($alias, $name);
        return $db ? res('success', '添加成功', $db) : res('dict_error', '词典信息创建失败,稍后再试');


    }
}