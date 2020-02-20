<?php
declare(strict_types=1);


namespace Woisks\Passport\Http\Controllers;


use Woisks\Passport\Models\Services\LogoutServices;

/**
 * Class LogoutController.
 *
 * @package Woisks\Passport\Http\Controllers
 *
 * @Author Maple Grove  <Woisks@126.com> 2020/1/29 18:05
 */
class LogoutController extends BaseController
{

    /**
     * @var LogoutServices
     */
    private $logoutServices;

    /**
     * LogoutController constructor. 2020/1/29 18:05.
     *
     * @param  LogoutServices  $logoutServices
     *
     * @return void
     */
    public function __construct(LogoutServices $logoutServices)
    {
        $this->logoutServices = $logoutServices;
    }

    /**
     * logout. 2020/1/29 18:05.
     *
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        return $this->logoutServices->logout();
    }
}
