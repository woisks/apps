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

namespace Woisks\Comment\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

abstract class Requests extends FormRequest
{

    /**
     * authorize 2019/5/10 11:45
     *
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }


    /**
     * rules 2019/5/10 11:45
     *
     *
     * @return mixed
     */
    abstract public function rules();
}