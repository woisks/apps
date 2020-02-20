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


use Illuminate\Validation\Rule;

/**
 * Class ChangeRequest.
 *
 * @package Woisks\User\Http\Requests
 *
 * @Author  Maple Grove  <bolelin@126.com> 2019/6/8 20:33
 */
class CreateRequest extends Requests
{

    /**
     * rules. 2019/6/8 20:33.
     *
     *
     * @return array|mixed
     */
    public function rules()
    {
        return [
            'background' => 'sometimes|numeric|digits_between:18,19',
            'avatar'     => 'sometimes|numeric|digits_between:18,19',

            'name'        => 'sometimes|required|string|min:2|max:15',
            'sign'        => 'sometimes|string|max:45',
            'gender'      => ['sometimes', Rule::in(['m', 'f', 'b'])],
            'is_gender'   => 'sometimes|required|boolean',
            'birthday'    => 'sometimes|required|date',
            'is_birthday' => 'sometimes|required|boolean'
        ];
    }
}
