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

namespace Woisks\Area\Models\Services;


use Woisks\Area\Models\Entity\ChinaCityEntity;
use Woisks\Area\Models\Entity\ChinaCountyEntity;
use Woisks\Area\Models\Entity\ChinaProvinceEntity;
use Woisks\Area\Models\Entity\ChinaTownEntity;
use Woisks\Area\Models\Entity\CountEntity;
use Woisks\Area\Models\Entity\CountryEntity;

/**
 * Class AreaServices.
 *
 * @package Woisks\Area\Models\Services
 *
 * @Author Maple Grove  <bolelin@126.com> 2019/8/1 16:42
 */
class AreaServices
{

    /**
     * increment. 2019/8/4 14:19.
     *
     * @param $type
     * @param $table
     * @param $numeric
     *
     * @return mixed
     */
    public static function increment($type, $table, $numeric)
    {
        $db = CountEntity::firstOrCreate(['type' => $type, 'table' => $table, 'numeric' => $numeric],
            ['id' => create_numeric_id()]);
        $db->increment('count');
        return $db;
    }


    public static function decrement($type, $table, $numeric)
    {
        $db = CountEntity::where('type', $type)->where('table', $table)->where('numeric', $numeric)->first();
        if ($db) {

            if ($db->count > 1) {
                $db->decrement('count');
                return $db;
            }
            return $db->delete();
        }

    }


    /**
     * get. 2019/8/4 14:25.
     *
     * @param $type
     * @param $table
     * @param  null  $numeric
     *
     * @return mixed
     */
    public static function get($type, $table, $numeric = null)
    {
        if ($numeric) {
            //city or county or town 返回单条数据
            return CountEntity::where('type', $type)->where('table', $table)->where('numeric', $numeric)->first();
        }

        //country or province 返回集合
        return CountEntity::where('type', $type)->where('table', $table)->get();

    }

    /**
     * exists. 2019/7/31 21:27.
     *
     * @param $table
     * @param $id
     *
     * @return bool
     */
    public static function exists($table, $id)
    {
        switch ($table) {
            case 'country':
                return CountryEntity::where('id', $id)->exists();
                break;
            case 'province':
                return ChinaProvinceEntity::where('province_id', $id)->exists();
                break;
            case 'city':
                return ChinaCityEntity::where('city_id', $id)->exists();
                break;
            case 'county':
                return ChinaCountyEntity::where('county_id', $id)->exists();
                break;
            case 'town':
                return ChinaTownEntity::where('town_id', $id)->exists();
                break;
            default:
                return false;
        }


    }

    /**
     * first. 2019/7/31 21:03.
     *
     * @param $table
     * @param $id
     *
     * @return mixed
     */
    public static function first($table, $id)
    {
        switch ($table) {
            case 'country':
                return CountryEntity::where('id', $id)->first();
                break;
            case 'province':
                return ChinaProvinceEntity::where('province_id', $id)->first();
                break;
            case 'city':
                return ChinaCityEntity::where('city_id', $id)->first();
                break;
            case 'county':
                return ChinaCountyEntity::where('county_id', $id)->first();
                break;
            case 'town':
                return ChinaTownEntity::where('town_id', $id)->first();
                break;
            default:
                return false;
        }

    }

    /**
     * cascade. 2019/8/1 16:42.
     *
     * 级联验证数据是否合法
     *
     * @param $country
     * @param $province
     * @param $city
     * @param $county
     * @param $town
     *
     * @return array|null
     */
    public static function cascade($country, $province, $city, $county, $town)
    {

        if ($country != 1) {
            //验证是不是中国
            $db = self::first('country', $country);
            if ($db) {
                return [
                    'country'     => $db->cn_name,
                    'country_id'  => $db->id,
                    'province'    => '',
                    'province_id' => 0,
                    'city'        => '',
                    'city_id'     => 0,
                    'county'      => '',
                    'county_id'   => 0,
                    'town'        => '',
                    'town_id'     => 0
                ];
            }
            return null;
        }

        //验证节点
        $node = [];

        if ($province && self::exists('province', $province)) {

            $node['id']    = $province;
            $node['table'] = 'province';
        }

        if ($city && self::exists('city', $city)) {

            $node['id']    = $city;
            $node['table'] = 'city';
        }

        if ($county && self::exists('county', $county)) {

            $node['id']    = $county;
            $node['table'] = 'county';
        }

        if ($town && self::exists('town', $town)) {

            $node['id']    = $town;
            $node['table'] = 'town';
        }

        if (empty($node)) {
            //如果为空直接返回中国
            return [
                'country'     => '中国',
                'country_id'  => 1,
                'province'    => '',
                'province_id' => 0,
                'city'        => '',
                'city_id'     => 0,
                'county'      => '',
                'county_id'   => 0,
                'town'        => '',
                'town_id'     => 0
            ];
        }
        return self::serivces($node['table'], $node['id']);
    }

    /**
     * serivces. 2019/8/1 16:42.
     *
     * @param $table
     * @param $id
     *
     * @return array
     */
    private static function serivces($table, $id)
    {
        switch ($table) {
            case 'town':
                $db = self::first('town', $id);
                [$country, $province, $city, $county, $town] = explode(',', $db->merger_name);
                return [
                    'country'     => '中国',
                    'country_id'  => 1,
                    'province'    => $province,
                    'province_id' => $db->province_id,
                    'city'        => $city,
                    'city_id'     => $db->city_id,
                    'county'      => $county,
                    'county_id'   => $db->county_id,
                    'town'        => $town,
                    'town_id'     => $db->town_id
                ];
                break;

            case 'county':
                $db = self::first('county', $id);
                [$country, $province, $city, $county] = explode(',', $db->merger_name);
                return [
                    'country'     => '中国',
                    'country_id'  => 1,
                    'province'    => $province,
                    'province_id' => $db->province_id,
                    'city'        => $city,
                    'city_id'     => $db->city_id,
                    'county'      => $county,
                    'county_id'   => $db->county_id,
                    'town'        => '',
                    'town_id'     => 0
                ];
                break;

            case 'city':
                $db = self::first('city', $id);
                [$country, $province, $city] = explode(',', $db->merger_name);
                return [
                    'country'     => '中国',
                    'country_id'  => 1,
                    'province'    => $province,
                    'province_id' => $db->province_id,
                    'city'        => $city,
                    'city_id'     => $db->city_id,
                    'county'      => '',
                    'county_id'   => 0,
                    'town'        => '',
                    'town_id'     => 0
                ];
                break;

            case 'province':
                $db = self::first('province', $id);
                [$country, $province] = explode(',', $db->merger_name);
                return [
                    'country'     => '中国',
                    'country_id'  => 1,
                    'province'    => $province,
                    'province_id' => $db->province_id,
                    'city'        => '',
                    'city_id'     => 0,
                    'county'      => '',
                    'county_id'   => 0,
                    'town'        => '',
                    'town_id'     => 0
                ];
                break;

            default:
                return [
                    'country'     => '中国',
                    'country_id'  => 1,
                    'province'    => '',
                    'province_id' => 0,
                    'city'        => '',
                    'city_id'     => 0,
                    'county'      => '',
                    'county_id'   => 0,
                    'town'        => '',
                    'town_id'     => 0
                ];
        }
    }


}
