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


use Woisks\Dict\Http\Requests\DeleteRequest;
use Woisks\Dict\Models\Services\DictDeleteServices;

/**
 * Class DeleteController.
 *
 * @package Woisks\Dict\Http\Controllers
 *
 * @Author Maple Forest  <Woisks@126.com> 2020/1/23 14:37
 */
class DeleteController extends BaseController
{
    /**
     * @var DictDeleteServices
     */
    private $deleteService;

    /**
     * DeleteController constructor. 2020/1/23 14:37.
     *
     * @param  DictDeleteServices  $deleteServices
     *
     * @return void
     */
    public function __construct(DictDeleteServices $deleteServices)
    {
        $this->deleteService = $deleteServices;
    }

    /**
     * delete. 2020/1/23 14:40.
     *
     * @param  DeleteRequest  $request
     *
     * @return mixed
     */
    public function delete(DeleteRequest $request)
    {
        $id = $request->input('id');
        $db = $this->deleteService->delete($id);
        return $db ? res('success', '删除成功', $db) : res('dict_error', '词典信息删除失败');
    }
}