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

class PassportSeeder extends Seeder
{
    public function run()
    {
        DB::table('passport_type_count')->insert([
            [
                'id'         => create_numeric_id(),
                'type'       => 'passport',
                'name'       => '会员总数',
                'readme'     => '全站注册独立会员总数',
                'created_at' => \Carbon\Carbon::now()->timestamp,
                'updated_at' => \Carbon\Carbon::now()->timestamp,
            ],
            [
                'id'         => create_numeric_id(),
                'type'       => 'username',
                'name'       => '用户名',
                'readme'     => '字母/数字及下划线(不区分大小写)',
                'created_at' => \Carbon\Carbon::now()->timestamp,
                'updated_at' => \Carbon\Carbon::now()->timestamp,
            ],
            [
                'id'         => create_numeric_id(),
                'type'       => 'phone',
                'name'       => '手机号码',
                'readme'     => '中国大陆内地,11位数字号码',
                'created_at' => \Carbon\Carbon::now()->timestamp,
                'updated_at' => \Carbon\Carbon::now()->timestamp,
            ],
            [
                'id'         => create_numeric_id(),
                'type'       => 'email',
                'name'       => '邮箱账号',
                'readme'     => '合法的电子邮箱地址',
                'created_at' => \Carbon\Carbon::now()->timestamp,
                'updated_at' => \Carbon\Carbon::now()->timestamp,
            ],
            [
                'id'         => create_numeric_id(),
                'type'       => 'numeric',
                'name'       => '数字账号',
                'readme'     => '账号别名,纯数字，方便记忆',
                'created_at' => \Carbon\Carbon::now()->timestamp,
                'updated_at' => \Carbon\Carbon::now()->timestamp,
            ]
        ]);
    }
}