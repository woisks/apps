<?php

declare(strict_types=1);

namespace Woisks\Agent;

use DeviceDetector\DeviceDetector;

/**
 * Class AgentService.
 *
 *
 * @Author  Maple Grove  <bolelin@126.com> 2019/5/18 17:25
 */
class AgentService
{
    /**
     * agent  2019/5/18 17:25.
     *
     * @var \DeviceDetector\DeviceDetector
     */
    private $agent;

    /**
     * os  2019/5/18 17:25.
     *
     * "name": "Windows",
     * "short_name": "WIN",
     * "version": "10",
     * "platform": "x64"
     *
     * @var array
     */
    private $os;

    /**
     * device  2019/5/18 17:25.
     *
     * 'desktop'
     * 'tablet'
     * 'tv'
     * 'car browser'
     *----phone---
     * 'smartphone'
     * 'phablet'
     * 'feature phone'
     * ---mobile---
     * 'console'
     * 'smart display'
     * 'camera'
     * 'portable media player'
     *
     * @var string
     */
    private $device;

    /**
     * client  2019/5/18 17:25.
     *
     * "type": "browser",
     * "name": "Chrome",
     * "short_name": "CH",
     * "version": "74.0",
     * "engine": "Blink",
     * "engine_version": ""
     *
     * @var array
     */
    private $client;

    /**
     * brand  2019/5/18 17:25.
     *
     * Samsung|iphone|…………
     *
     * @var string
     */
    private $brand;

    /**
     * model  2019/5/18 17:25.
     *
     * c9pro|s9|s10|…………
     *
     * @var string
     */
    private $model;

    /**
     * AgentService constructor. 2019/5/18 17:25.
     *
     *
     * @return void
     */
    public function __construct()
    {
        $this->agent = new DeviceDetector($_SERVER['HTTP_USER_AGENT']);
        $this->agent->parse();

        $this->os = $this->agent->getOs();
        $this->client = $this->agent->getClient();
        $this->device = $this->agent->getDeviceName();
        $this->brand = $this->agent->getBrandName();
        $this->model = $this->agent->getModel();
    }

    /**
     * info 2019/6/6 14:21.
     *
     *
     * @return array
     */
    public static function info(): array
    {
        return (new self())->info_array();
    }

    /**
     * info_array 2019/5/18 17:56.
     *
     *
     * @return array
     */
    private function info_array()
    {
        return [
            'os'          => $this->info_os(),
            'device'      => $this->info_device(),
            'client'      => $this->info_client(),
            'brand_model' => $this->brand.' '.$this->model,
        ];
    }

    /**
     * info_os 2019/5/18 17:56.
     *
     *
     * @return string
     */
    private function info_os()
    {
        return $this->os['name'].' '.$this->os['version'];
    }

    /**
     * info_device 2019/5/18 17:56.
     *
     *
     * @return string
     */
    private function info_device()
    {
        $device_name = $this->device;

        if ($device_name == 'smartphone' || $device_name == 'phablet' || $device_name == 'feature phone') {
            $device_name = 'phone';
        }

        if ($device_name == 'console' || $device_name == 'smart display' || $device_name == 'camera' || $device_name == 'portable media player') {
            $device_name = 'mobile';
        }

        return $device_name;
    }

    /**
     * info_client 2019/5/18 17:56.
     *
     *
     * @return string
     */
    private function info_client()
    {
        return $this->client['name'].' '.$this->client['version'];
    }
}
