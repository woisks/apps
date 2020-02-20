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

class UserSeeder extends Seeder
{
    public function run()
    {
        DB::table('user_extend_attribute')->insert([
            [
                'id'    => create_numeric_id(),
                'alias' => 'country',
                'name'  => '国家',
                'count' => 0,
            ],
            [
                'id'    => create_numeric_id(),
                'alias' => 'province',
                'name'  => '省份',
                'count' => 0,
            ],
            [
                'id'    => create_numeric_id(),
                'alias' => 'city',
                'name'  => '城市',
                'count' => 0,
            ],
            [
                'id'    => create_numeric_id(),
                'alias' => 'county',
                'name'  => '区县',
                'count' => 0,
            ],
            [
                'id'    => create_numeric_id(),
                'alias' => 'town',
                'name'  => '乡镇',
                'count' => 0,
            ],

        ]);
    }
}