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


use Woisks\Count\Http\Requests\CreateRequest;
use Woisks\Count\Models\Services\CountServices;

/**
 * Class CountController.
 *
 * @package Woisks\Count\Http\Controllers
 *
 * @Author Maple Grove  <Woisks@126.com> 2020/2/2 11:10
 */
class CountController extends BaseController
{
    /**
     * @var CountServices
     */
    private $countServices;

    /**
     * CountController constructor. 2020/2/2 11:10.
     *
     * @param  CountServices  $countServices
     *
     * @return void
     */
    public function __construct(CountServices $countServices)
    {
        $this->countServices = $countServices;
    }

    /**
     * change. 2020/2/2 13:28.
     *
     * @param  CreateRequest  $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function change(CreateRequest $request)
    {
        return $this->countServices->change($request);
    }

    
}