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

namespace Woisks\Contact\Models\Services;

use Woisks\Contact\Models\Repository\IspRepository;

/**
 * Class ISPServices.
 *
 * @package Woisks\Contact\Models\Services
 *
 * @Author Maple Grove  <Woisks@126.com> 2020/2/1 16:35
 */
class ISPServices
{
    /**
     * @var IspRepository
     */
    private $ispRepo;

    /**
     * ISPServices constructor. 2020/2/1 16:35.
     *
     * @param  IspRepository  $ispRepo
     *
     * @return void
     */
    public function __construct(IspRepository $ispRepo)
    {
        $this->ispRepo = $ispRepo;
    }

    /**
     * exists. 2020/2/1 16:35.
     *
     * @param $isp_id
     *
     * @return mixed
     */
    public function exists($isp_id)
    {
        return $this->ispRepo->exists($isp_id);
    }


    /**
     * increment. 2020/2/1 16:53.
     *
     * @param $id
     *
     * @return int
     */
    public function increment($id)
    {
        return $this->ispRepo->increment($id);
    }


    /**
     * decrement. 2020/2/1 16:53.
     *
     * @param $id
     *
     * @return int
     */
    public function decrement($id)
    {
        return $this->ispRepo->decrement($id);
    }

    /**
     * get. 2020/2/1 18:28.
     *
     *
     * @return mixed
     */
    public function get()
    {
        $db = $this->ispRepo->get();

        $data = [];
        foreach ($db as $item) {
            $data[$item->id] = $item;
        }

        return res('success', '获取成功', $data);
    }
}