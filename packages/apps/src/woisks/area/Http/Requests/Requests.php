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

namespace Woisks\Area\Http\Requests;


use Illuminate\Foundation\Http\FormRequest;

/**
 * Class Requests.
 *
 * @package Woisks\Area\Http\Requests
 *
 * @Author  Maple Grove  <bolelin@126.com> 2019/6/10 10:44
 */
abstract class Requests extends FormRequest
{
    /**
     * authorize. 2019/6/10 10:44.
     *
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * rules. 2019/6/10 10:44.
     *
     *
     * @return mixed
     */
    abstract public function rules();
}