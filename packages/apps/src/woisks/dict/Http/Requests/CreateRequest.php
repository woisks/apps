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

namespace Woisks\Dict\Http\Requests;


/**
 * Class CreateRequest.
 *
 * @package Woisks\Dict\Http\Requests
 *
 * @Author Maple Forest  <Woisks@126.com> 2020/1/23 14:29
 */
class CreateRequest extends Requests
{

    /**
     * rules. 2020/1/23 14:29.
     *
     *
     * @return array|mixed
     */
    public function rules()
    {
        return [
            'alias' => 'required|string|min:2|max:20',
            'name'  => 'required|string|min:2|max:20'
        ];
    }
}