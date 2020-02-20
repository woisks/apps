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

namespace Woisks\Tag\Http\Controllers;


use Woisks\Tag\Http\Requests\CreateRequest;
use Woisks\Tag\Http\Requests\GetRequest;
use Woisks\Tag\Models\Services\TagServices;

/**
 * Class TagController.
 *
 * @package Woisks\Tag\Http\Controllers
 *
 * @Author Maple Grove  <Woisks@126.com> 2020/1/31 19:14
 */
class TagController extends BaseController
{
    /**
     * @var TagServices
     */
    private $tagServices;

    /**
     * TagController constructor. 2020/1/31 19:14.
     *
     * @param  TagServices  $tagServices
     *
     * @return void
     */
    public function __construct(TagServices $tagServices)
    {
        $this->tagServices = $tagServices;
    }

    /**
     * create. 2020/1/31 19:14.
     *
     * @param  CreateRequest  $request
     *
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function create(CreateRequest $request)
    {
        return $this->tagServices->create($request);
    }

    /**
     * get. 2020/1/31 19:41.
     *
     * @param  GetRequest  $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function get(GetRequest $request)
    {
        return $this->tagServices->get($request);
    }

    public function index($tag_id)
    {
        return $this->tagServices->index($tag_id);
    }

}