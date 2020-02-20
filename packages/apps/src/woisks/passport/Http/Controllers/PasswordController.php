<?php
declare(strict_types=1);


namespace Woisks\Passport\Http\Controllers;


use Woisks\Passport\Models\Services\PasswordServices;

/**
 * Class PasswordController.
 *
 * @package Woisks\Passport\Http\Controllers
 *
 * @Author Maple Grove  <Woisks@126.com> 2020/1/29 20:29
 */
class PasswordController extends BaseController
{
    /**
     * @var PasswordServices
     */
    public $passwordServices;

    /**
     * PasswordController constructor. 2020/1/29 20:29.
     *
     * @param  PasswordServices  $passwordServices
     *
     * @return void
     */
    public function __construct(PasswordServices $passwordServices)
    {
        $this->passwordServices = $passwordServices;

    }


    /**
     * update. 2020/1/29 20:29.
     *
     * @param  UpdatePasswordRequest  $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdatePasswordRequest $request)
    {
        return $this->passwordServices->update($request);
    }


    /**
     * reset. 2020/1/29 20:29.
     *
     * @param  ResetPasswordRequest  $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function reset(ResetPasswordRequest $request)
    {
        return $this->passwordServices->reset($request);
    }


}
