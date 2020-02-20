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

namespace Woisks\Media\Http\Requests;


class PhotoRequest extends Requests
{
    public function rules()
    {
        return [
            'upload'     => 'required|image|max:4096',
            'module'     => 'required|string|max:20',
            'folder'     => 'sometimes|required|numeric|digits_between:18,19',
            'title'      => 'sometimes|required|string|max:18',
            'readme'     => 'sometimes|required|string|max:140',
            'is_comment' => 'sometimes|boolean'

        ];
    }

}
