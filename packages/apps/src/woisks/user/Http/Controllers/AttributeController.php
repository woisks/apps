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

namespace Woisks\User\Http\Controllers;


use Woisks\User\Models\Services\AttributeServices;

class AttributeController extends BaseController
{
    private $attributeServices;

    public function __construct(AttributeServices $attributeServices)
    {
        $this->attributeServices = $attributeServices;
    }

    public function create()
    {

    }
}