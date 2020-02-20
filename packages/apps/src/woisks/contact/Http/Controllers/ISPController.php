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


use Woisks\Contact\Models\Services\ISPServices;

class ISPController extends BaseController
{
    private $ispServices;

    public function __construct(ISPServices $ispServices)
    {
        $this->ispServices = $ispServices;
    }

    public function get()
    {
        return $this->ispServices->get();
    }
}