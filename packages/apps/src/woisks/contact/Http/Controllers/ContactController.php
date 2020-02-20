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

namespace Woisks\Contact\Http\Controllers;


use Woisks\Contact\Http\Requests\CreateRequest;
use Woisks\Contact\Models\Services\ContactServices;

/**
 * Class ContactController.
 *
 * @package Woisks\Contact\Http\Controllers
 *
 * @Author Maple Grove  <Woisks@126.com> 2020/2/1 17:19
 */
class ContactController extends BaseController
{
    /**
     * @var ContactServices
     */
    private $contactServices;

    /**
     * ContactController constructor. 2020/2/1 17:19.
     *
     * @param  ContactServices  $contactServices
     *
     * @return void
     */
    public function __construct(ContactServices $contactServices)
    {
        $this->contactServices = $contactServices;
    }

    /**
     * create. 2020/2/1 17:19.
     *
     * @param  CreateRequest  $request
     *
     * @return \Illuminate\Http\JsonResponse|void
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function create(CreateRequest $request)
    {
        return $this->contactServices->create($request);
    }

    /**
     * folder_get. 2020/2/1 18:13.
     *
     * @param $folder_id
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function folder_get($folder_id)
    {
        return $this->contactServices->folder_get($folder_id);
    }

    public function delete($id)
    {
        return $this->contactServices->delete($id);
    }
}