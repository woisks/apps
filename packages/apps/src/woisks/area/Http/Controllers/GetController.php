<?php

declare(strict_types=1);

/*
 * +----------------------------------------------------------------------+
 * |                   At all timesI love the moment                      |
 * +----------------------------------------------------------------------+
 * | Copyright (c) 2019 www.Woisk.com All rights reserved.                |
 * +----------------------------------------------------------------------+
 * |  Author:  Maple Grove  <bolelin@126.com>   QQ:364956690   286013629  |
 * +----------------------------------------------------------------------+
 */

namespace Woisks\Area\Http\Controllers;


use Illuminate\Http\JsonResponse;
use Woisks\Area\Models\Repository\CountRepository;

/**
 * Class GetController.
 *
 * @package Woisks\Area\Http\Controllers
 *
 * @Author Maple Grove  <bolelin@126.com> 2019/8/4 15:22
 */
class GetController extends BaseController
{

    /**
     * countRepo.  2019/8/4 15:22.
     *
     * @var  CountRepository
     */
    private $countRepo;

    /**
     * GetController constructor. 2019/8/4 15:22.
     *
     * @param  CountRepository  $countRepo
     *
     * @return void
     */
    public function __construct(CountRepository $countRepo)
    {
        $this->countRepo = $countRepo;
    }

    /**
     * first. 2019/8/4 15:22.
     *
     * @param $type
     * @param $table
     * @param $id
     *
     * @return JsonResponse
     */
    public function first($type, $table, $id)
    {
        if ($table != 'country' && $table != 'province' && $table != 'city' && $table != 'county' && $table != 'town') {
            return res('area_table_not_exists', '地址数据错误');
        }

        $db = $this->countRepo->first($type, $table, $id);
        if (!$db) {
            return res('area_data_not_exists ', '地址数据不存在');
        }

        return res('success', 'success', $db);
    }


}
