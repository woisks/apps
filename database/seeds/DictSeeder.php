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

use Illuminate\Database\Seeder;

class DictSeeder extends Seeder
{
    public function run()
    {

        DB::table('dict')->insert([
            [
                'id'    => create_numeric_id(),
                'alias' => 'article',
                'name'  => '文章',
            ],
            [
                'id'    => create_numeric_id(),
                'alias' => 'tag',
                'name'  => '标签',
            ],
            [
                'id'    => create_numeric_id(),
                'alias' => 'like',
                'name'  => '喜欢',
            ],
            [
                'id'    => create_numeric_id(),
                'alias' => 'comment',
                'name'  => '评论',

            ],
            [
                'id'    => create_numeric_id(),
                'alias' => 'photo',
                'name'  => '图片',
            ],
            [
                'id'    => create_numeric_id(),
                'alias' => 'folder',
                'name'  => '文件夹',
            ],


            [
                'id'    => create_numeric_id(),
                'alias' => 'reply',
                'name'  => '回复',

            ],
            [
                'id'    => create_numeric_id(),
                'alias' => 'contact',
                'name'  => '联系信息',

            ],


            [
                'id' => create_numeric_id(),

                'alias' => 'user',
                'name'  => '用户',

            ],

            [
                'id'    => create_numeric_id(),
                'alias' => 'follow',
                'name'  => '关注',
            ],

        ]);

    }
}
