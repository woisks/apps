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

namespace Woisks\Dict\Models\Services;

use Woisks\Dict\Models\Repository\DictRepository;

/**
 * Class DictDeleteServices.
 *
 * @package Woisks\Dict\Models\Services
 *
 * @Author Maple Forest  <Woisks@126.com> 2020/1/21 15:44
 */
class DictDeleteServices
{
    /**
     * @var DictRepository
     */
    private $dictRepo;

    /**
     * DictDeleteServices constructor. 2020/1/21 15:44.
     *
     * @param  DictRepository  $dictRepo
     *
     * @return void
     */
    public function __construct(DictRepository $dictRepo)
    {
        $this->dictRepo = $dictRepo;
    }


    /**
     * delete. 2020/1/21 15:55.
     *
     * @param $id
     *
     * @return mixed
     */
    public function delete($id)
    {
        return $this->dictRepo->delete($id);
    }
}