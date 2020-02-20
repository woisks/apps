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

namespace Woisks\Count\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class Requests.
 *
 * @package Woisks\Count\Http\Requests
 *
 * @Author Maple Grove  <Woisks@126.com> 2020/2/2 11:18
 */
abstract class Requests extends FormRequest
{
    /**
     * authorize. 2020/2/2 11:18.
     *
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }


    /**
     * rules. 2020/2/2 11:18.
     *
     *
     * @return mixed
     */
    abstract public function rules();
}