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


use Carbon\Carbon;

if (!function_exists('random_numeric')) {

    /**
     * random_numeric max:19 bit 2019/5/15 22:04
     *随机生成int 数字
     *
     * @param  int  $numeric  数字长度
     *
     * @return int
     */
    function random_numeric(int $numeric = 6): int
    {
        return (int) base_random_numeric('1-9', $numeric);
    }
}

if (!function_exists('random_string')) {

    /**
     * random_string 2019/5/10 12:09
     * 随机生成字符
     *
     * @param  int  $numeric  字符长度
     *
     * @return string
     */
    function random_string(int $numeric = 8): string
    {
        return base_random_numeric('a-z', $numeric);
    }
}

if (!function_exists('create_numeric_uid')) {


    /**
     * create_numeric_uid 2019/5/10 12:09
     * 创建账号
     *
     * @param  int  $nodes  节点 int
     *
     * @return int
     */
    function create_numeric_uid(int $nodes = 1): int
    {
        return (int) (Carbon::now()->timestamp.base_random_numeric('0-9', 7).$nodes);
    }
}

if (!function_exists('create_numeric_id')) {


    /**
     * create_numeric_id 2019/5/10 12:09
     * 创建数据ID
     *
     * @return int
     */
    function create_numeric_id(): int
    {
        return (int) (Carbon::now()->timestamp.base_random_numeric('0-9', 8));

    }
}

if (!function_exists('create_photo_id')) {


    /**
     * create_photo_id 2019/5/10 12:09
     * 创建图片ID 17位
     *
     * @return int
     */
    function create_photo_id(): int
    {
        return (int) (Carbon::now()->timestamp.base_random_numeric('0-9', 7));

    }
}

if (!function_exists('create_photo_type')) {


    /**
     * create_photo_type. 2019/7/30 21:12.
     * 存储位置区分
     *
     * @param $str
     *
     * @return int
     */
    function create_photo_type($str = null): int
    {
        if (empty($str)) {
            //七牛
            return (int) collect([1, 3, 5, 7, 9])->random();
        }
        //其它
        return (int) collect([2, 4, 6, 8, 0])->random();
    }
}

if (!function_exists('base_random_numeric')) {


    /**
     * base_random_numeric 2019/5/10 12:09
     *
     * @param  string  $string
     * @param  int  $int
     *
     * @return string
     */
    function base_random_numeric(string $string, int $int): string
    {
        $str = '';
        if ($string == '0-9') {

            $characters = str_repeat('0123456789', $int);
            $str        = substr(str_shuffle($characters), 0, $int);
        }
        if ($string == '1-9') {
            $characters = str_repeat('123456789', $int);
            $str        = substr(str_shuffle($characters), 0, $int);
        }
        if ($string == 'a-z') {
            $characters = str_repeat('abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789', $int);
            $str        = substr(str_shuffle($characters), 0, $int);
        }

        return $str;
    }
}