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

use Illuminate\Database\Seeder;

class ContactSeeder extends Seeder
{
    public function run()
    {
        DB::table('contact_isp')->insert([
            [
                'id'     => create_numeric_id(),
                'alias'  => 'qq',
                'name'   => 'QQ',
                'readme' => '',
                'url'    => 'im.qq.com',
            ],
            [
                'id'     => create_numeric_id(),
                'alias'  => 'vx',
                'name'   => '微信',
                'readme' => '',
                'url'    => 'wx.qq.com',
            ],

        ]);
    }
}