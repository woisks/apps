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

namespace Woisks\Comment\Http\Controllers;


use Woisks\Comment\Http\Requests\CreateRequest;
use Woisks\Comment\Models\Services\CommentServices;

/**
 * Class CommentController.
 *
 * @package Woisks\Comment\Http\Controllers
 *
 * @Author Maple Grove  <Woisks@126.com> 2020/2/1 11:04
 */
class CommentController extends BaseController
{
    /**
     * @var CommentServices
     */
    private $commentServices;

    /**
     * CommentController constructor. 2020/2/1 11:04.
     *
     * @param  CommentServices  $commentServices
     *
     * @return void
     */
    public function __construct(CommentServices $commentServices)
    {
        $this->commentServices = $commentServices;
    }

    /**
     * create. 2020/2/1 11:04.
     *
     * @param  CreateRequest  $request
     *
     * @return \Illuminate\Http\JsonResponse|mixed
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function create(CreateRequest $request)
    {
        return $this->commentServices->create($request);
    }

    /**
     * delete. 2020/2/1 11:04.
     *
     * @param $id
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete($id)
    {
        return $this->commentServices->delete($id);
    }

    /**
     * get_uid. 2020/2/1 11:04.
     *
     * @param $uid
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function get_uid($uid)
    {
        return $this->commentServices->get_uid($uid);
    }

    /**
     * module_numeric. 2020/2/1 11:04.
     *
     * @param $module
     * @param $numeric
     *
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function module_numeric($module, $numeric)
    {
        return $this->commentServices->module_numeric($module, $numeric);
    }

    public function reply($id)
    {
        return $this->commentServices->reply($id);
    }
}