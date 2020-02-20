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

namespace Woisks\Contact\Http\Requests;


class CreateRequest extends Requests
{
    public function rules()
    {
        return [
            'folder_id' => 'required|numeric|digits_between:18,19',
            'isp_id'    => 'required|numeric|digits_between:18,19',
            'qrcode_id' => 'sometimes|required|numeric|digits_between:18,19',
            'passport'  => 'required|string|min:2|max:255',
            'title'     => 'sometimes|required|string|min:1|max:15',
            'readme'    => 'sometimes|required|string|min:1|max:140'
        ];
    }

}