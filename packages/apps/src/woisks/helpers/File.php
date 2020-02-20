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

if (!function_exists('config_toFile')) {

    /**
     * config_toFile 2019/5/21 14:04
     * 转换文件到config目录
     *
     * @param  string  $filename
     * @param  array  $data
     *
     * @return bool|int
     */
    function config_toFile(string $filename, array $data)
    {
        $path = base_path().'\config\\'.$filename.'.php';
        $str  = '<?php return '.var_export($data, true).';';

        return file_put_contents($path, $str);
    }
}


if (!function_exists('unlink_file')) {

    /**
     * unlink_file 2019/5/21 13:53
     * 删除指定路径的文件
     *
     * @param  string  $file_path_and_name
     *
     * @return void
     */
    function unlink_file(string $file_path_and_name)
    {
        if (file_exists($file_path_and_name)) {

            unlink($file_path_and_name);
        }
    }
}