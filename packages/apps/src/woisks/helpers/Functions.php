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

if (!function_exists('is_email_and_check_dns')) {
    /**
     * is_email_and_check_dns 2019/5/15 21:51
     *
     * @param  string  $email
     *
     * @return bool
     */
    function is_email_and_check_dns(string $email): bool
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return false;
        }

        $host = $email;

        if ($lastAtPos = strrpos($email, '@')) {
            $host = substr($email, $lastAtPos + 1);
        }

        return check_dns($host);
    }
}
if (!function_exists('check_dns')) {
    /**
     * check_dns 2019/5/15 21:01
     *
     * @param  string  $host
     *
     * @return bool
     */
    function check_dns(string $host): bool
    {
        $variant = INTL_IDNA_VARIANT_2003;
        if (defined('INTL_IDNA_VARIANT_UTS46')) {
            $variant = INTL_IDNA_VARIANT_UTS46;
        }
        $host = rtrim(idn_to_ascii($host, IDNA_DEFAULT, $variant), '.').'.';

        if (checkdnsrr($host, 'MX') && (checkdnsrr($host, 'A') || checkdnsrr($host, 'AAAA'))) {
            return true;
        }

        return false;
    }
}
if (!function_exists('is_phone')) {


    /**
     * is_phone 2019/5/10 12:09
     *
     * @param  string  $phone
     *
     * @return bool
     */
    function is_phone(string $phone): bool
    {
        $search = '/^1(3[0-9]|4[57]|5[0-35-9]|6[6]|7[0135678]|8[0-9])\d{8}$/';
        if (preg_match($search, $phone)) {
            return true;
        }

        return false;
    }
}


if (!function_exists('is_username')) {


    /**
     * is_username 2019/5/10 12:09
     *
     * @param  string  $username
     *
     * @return bool
     */
    function is_username(string $username): bool
    {
        $search = '/^[a-zA-Z][-_a-zA-Z0-9]+$/';
        if (preg_match($search, $username)) {
            return true;
        }

        return false;
    }
}

if (!function_exists('is_email')) {
    /**
     * is_email 2019/5/15 21:10
     *
     * @param  string  $email
     *
     * @return bool
     */
    function is_email(string $email): bool
    {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return true;
        }

        return false;
    }
}

if (!function_exists('is_number')) {
    /**
     * sk_is_numeric 2019/5/15 21:31
     *
     * @param  string  $numeric
     *
     * @return bool
     */
    function is_number(string $numeric): bool
    {
        if (filter_var($numeric, FILTER_VALIDATE_INT)) {
            return true;
        }

        return false;
    }
}

if (!function_exists('account_type')) {

    /**
     * account_type 2019/5/10 12:09
     *
     * @param  string  $username
     *
     * @return string
     */
    function account_type(string $username): string
    {
        switch ($username) {
            case is_phone($username):
                $str = 'phone';
                break;
            case is_email($username):
                $str = 'email';
                break;
            case is_number($username):
                $str = 'numeric';
                break;
            default:
                $str = 'username';
                break;
        }

        return $str;
    }
}
if (!function_exists('is_username_nonce')) {

    /**
     * is_username_nonce. 2019/11/19 11:33.
     *
     * @param  string  $username
     *
     * @return string
     */
    function is_username_nonce(string $username): string
    {
        if (is_phone($username)) {
            return substr($username, 0, 3).str_repeat('*', 6).substr($username, -1 - 1);
        }

        if (is_email($username)) {

            $str = \Str::before($username, '@');
            return substr($str, 0, 3).str_repeat('*', strlen($str) - 3).'@'.\Str::after($username, '@');
        }

        return $username;
    }
}
