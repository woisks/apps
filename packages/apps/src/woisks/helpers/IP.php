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

/**
 * tips:
 *   "require": {
 *      "ext-bcmath": "*"
 *     }
 */

if (!function_exists('is_ipv4')) {
    /**
     * is_ipv4. 2019/11/19 9:16.
     *
     * @param $ip
     *
     * @return bool
     */
    function is_ipv4($ip): bool
    {
        if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4)) {
            return true;
        }
        return false;

    }
}

if (!function_exists('is_ipv6')) {
    /**
     * is_ipv6. 2019/11/19 9:16.
     *
     * @param $ip
     *
     * @return bool
     */
    function is_ipv6($ip): bool
    {
        if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV6)) {
            return true;
        }
        return false;

    }
}
if (!function_exists('is_ip_nonce')) {

    /**
     * is_ip_nonce. 2019/11/19 11:33.
     *
     * @param  string  $ip
     *
     * @return string
     */
    function is_ip_nonce(string $ip): string
    {
        $nonce        = '*';
        $ipv4_explode = '.';
        $ipv6_explode = ':';
        $ip_type      = '';
        $arr          = [];
        if (is_ipv4($ip)) {
            $arr     = explode($ipv4_explode, $ip);
            $ip_type = 'ipv4';
        }
        if (is_ipv6($ip)) {
            $arr     = explode($ipv6_explode, $ip);
            $ip_type = 'ipv6';
        }

        $count = count($arr);
        $node  = $count - 2;
        $str   = '';
        $first = $arr[0];
        $last  = $arr[$count - 1];


        for ($i = 1; $i <= $node; $i++) {

            if (is_ipv4($ip)) {
                $node_str   = '';
                $node_count = strlen($arr[$i]);
                for ($j = 0; $j <= $node_count; $j++) {
                    $node_str .= $nonce;
                }
                $str .= $node_str.$ipv4_explode;
            }

            if (is_ipv6($ip)) {
                $node_str   = '';
                $node_count = strlen($arr[$i]);
                for ($j = 0; $j <= $node_count; $j++) {
                    $node_str .= $nonce;
                }
                $str .= $node_str.$ipv6_explode;
            }

        }

        return $ip_type === 'ipv4' ? $first.$ipv4_explode.$str.$last : $first.$ipv6_explode.$str.$last;
    }
}
if (!function_exists('ip_string_decode')) {
    /**
     * ip_string_decode 2019/5/21 16:17
     *
     * @param  string  $ip2long
     *
     * @return string
     */
    function ip_string_decode(string $ip2long)
    {


        $len = strlen($ip2long);

        if ($len > 30) {
            if (!function_exists('bcadd')) {
                throw new \RuntimeException('BCMATH extension not installed!');
            }
            $bin = '';
            do {
                $bin     = bcmod($ip2long, '2').$bin;
                $ip2long = bcdiv($ip2long, '2', 0);
            } while (bccomp($ip2long, '0'));

            $bin = str_pad($bin, 128, '0', STR_PAD_LEFT);

            $ip = [];
            for ($bit = 0; $bit <= 7; $bit++) {
                $bin_part = substr($bin, $bit * 16, 16);
                $ip[]     = dechex(bindec($bin_part));
            }
            $ip = implode(':', $ip);
            return (string) strtoupper(inet_ntop(inet_pton($ip)));

        }

        return long2ip((int) $ip2long);
    }
}


if (!function_exists('ip_string_encode')) {

    /**
     * ip_string_encode 2019/6/6 21:03
     *
     * @param $ip
     *
     * @return string
     */
    function ip_string_encode($ip)
    {
        $ip   = is_int($ip) ? (string) $ip : $ip;
        $bool = (bool) filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV6);

        if ($bool) {

            if (!function_exists('bcadd')) {
                throw new \RuntimeException('BCMATH extension not installed!');
            }

            $ip_n = inet_pton($ip);
            $bin  = '';
            for ($bit = strlen($ip_n) - 1; $bit >= 0; $bit--) {
                $bin = sprintf('%08b', ord($ip_n[$bit])).$bin;
            }

            $dec = '0';
            for ($i = 0; $i < strlen($bin); $i++) {
                $dec = bcmul($dec, '2', 0);
                $dec = bcadd($dec, $bin[$i], 0);
            }

            return $dec;
        }

        return (string) ip2long($ip);

    }
}