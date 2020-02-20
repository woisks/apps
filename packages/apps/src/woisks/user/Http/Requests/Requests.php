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

namespace Woisks\User\Http\Requests;


use Illuminate\Foundation\Http\FormRequest;

/**
 * Class Requests.
 *
 * @package Woisks\User\Http\Requests
 *
 * @Author  Maple Grove  <bolelin@126.com> 2019/6/8 20:14
 */
abstract class Requests extends FormRequest
{
    /**
     * authorize. 2019/6/8 20:14.
     *
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * rules. 2019/6/8 20:14.
     *
     *
     * @return mixed
     */
    abstract public function rules();
}