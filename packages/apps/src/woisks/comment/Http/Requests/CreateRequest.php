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


class CreateRequest extends Requests
{
    public function rules()
    {
        return [
            'module'    => 'required|string|min:2|max:20',
            'numeric'   => 'required|numeric|digits_between:18,19',
            'content'   => 'required|string',
            'parent_id' => 'sometimes|required|numeric|digits_between:18,19',
            'is_reply'  => 'sometimes|required|boolean',
        ];
    }

}