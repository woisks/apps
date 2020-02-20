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

if (!function_exists('substr_text')) {
    /**
     * substr_text. 2019/11/21 11:40.
     * 传入html string 截取 numeric
     *
     * @param  string  $text
     * @param  int  $numeric
     *
     * @return string
     */
    function substr_text(string $text, int $numeric)
    {
        $except = trim(strip_tags($text));

        return mb_substr($except, 0, $numeric, 'utf8');
    }
}

if (!function_exists('words_len')) {
    /**
     * words_len. 2019/8/2 12:25.
     * 统计文字长度，去除html标签
     *
     * @param $text
     *
     * @return bool|int
     */
    function words_len($text)
    {
        $except = trim(strip_tags($text));

        return mb_strlen($except, 'utf8');
    }
}