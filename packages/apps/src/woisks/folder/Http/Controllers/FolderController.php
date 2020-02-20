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

namespace Woisks\Folder\Http\Controllers;


use Illuminate\Http\Request;
use Woisks\Folder\Http\Requests\CreateRequest;

use Woisks\Folder\Models\Services\FolderServices;

/**
 * Class FolderController.
 *
 * @package Woisks\Folder\Http\Controllers
 *
 * @Author Maple Grove  <Woisks@126.com> 2020/1/30 11:58
 */
class FolderController extends BaseController
{

    /**
     * @var FolderServices
     */
    private $folderServices;


    /**
     * FolderController constructor. 2020/1/30 11:58.
     *
     * @param  FolderServices  $folderServices
     *
     * @return void
     */
    public function __construct(FolderServices $folderServices)
    {
        $this->folderServices = $folderServices;
    }


    /**
     * create. 2020/1/30 11:58.
     *
     * @param  CreateRequest  $request
     *
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function create(CreateRequest $request)
    {
        return $this->folderServices->create($request);
    }


    /**
     * public_folder. 2020/1/30 11:58.
     *
     * @param $uid
     * @param $module
     *
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function public_folder($uid, $module)
    {
        return $this->folderServices->public_folder($uid, $module);
    }


    /**
     * get. 2020/1/30 11:58.
     *
     * @param $module
     *
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function get($module)
    {
        return $this->folderServices->get($module);
    }

    /**
     * update. 2020/1/30 14:28.
     *
     * @param  Request  $request
     * @param $id
     *
     * @return \Illuminate\Http\JsonResponse|mixed
     */
    public function update(Request $request, $id)
    {
        return $this->folderServices->update($request, $id);
    }

    /**
     * del. 2020/1/30 14:30.
     *
     * @param $id
     *
     * @return mixed
     */
    public function delete($id)
    {
        return $this->folderServices->delete($id);
    }
}