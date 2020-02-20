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

namespace Woisks\Media\Http\Controllers;


use Woisks\Media\Http\Requests\PhotoRequest;
use Woisks\Media\Models\Services\PhotoServices;

class PhotoController extends BaseController
{
    private $photoServices;

    public function __construct(PhotoServices $photoServices)
    {
        $this->photoServices = $photoServices;
    }

    public function create(PhotoRequest $request)
    {
        return $this->photoServices->create($request);
    }
}