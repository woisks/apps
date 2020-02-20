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

namespace Woisks\Folder\Http\Requests;


class CreateRequest extends Requests
{
    public function rules()
    {
        return [
            'module'      => 'required|string|min:2|max:20',
            'cover_photo' => 'sometimes|required|numeric|digits_between:18,19',
            'title'       => 'required|string|min:2|max:18',
            'readme'      => '',
            'is_public'   => 'sometimes|required|boolean'

        ];
    }

}