<?php
declare(strict_types=1);


namespace Woisks\Passport\Http\Controllers;


use Woisks\Captcha\Http\Requests\UsernameRequest;
use Woisks\Passport\Models\Services\PassportServices;

/**
 * Class PassportController
 *
 * @package Woisks\PassportEntity\Http\Controllers
 *
 * @Author  Maple Grove  <bolelin@126.com> 2019/5/14 14:33
 */
class PassportController extends BaseController
{
    /**
     * @var PassportServices
     */
    private $passportServices;

    /**
     * PassportController constructor. 2020/1/29 20:00.
     *
     * @param  PassportServices  $passportServices
     *
     * @return void
     */
    public function __construct(PassportServices $passportServices)
    {
        $this->passportServices = $passportServices;
    }


    /**
     * get. 2020/1/29 20:00.
     *
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function get()
    {
        return $this->passportServices->get();
    }


    /**
     * add. 2020/1/29 20:03.
     *
     * @param  UsernameRequest  $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function add(UsernameRequest $request)
    {
        return $this->passportServices->add($request);
    }


    /**
     * del. 2020/1/29 20:04.
     *
     * @param  UsernameRequest  $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function del(UsernameRequest $request)
    {
        return $this->passportServices->del($request);
    }


    /**
     * bind. 2020/1/29 20:04.
     *
     * @param  UsernameRequest  $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function bind(UsernameRequest $request)
    {
        return $this->passportServices->bind($request);
    }


    /**
     * update. 2020/1/29 20:04.
     *
     * @param  UsernameRequest  $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UsernameRequest $request)
    {
        return $this->passportServices->update($request);
    }

}
