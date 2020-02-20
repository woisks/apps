<?php
declare(strict_types=1);


namespace Woisks\Passport\Http\Controllers;

use Woisks\Passport\Http\Requests\LoginRequest;
use Woisks\Passport\Models\Services\LoginServices;


/**
 * Class LoginController
 *
 * @package Woisks\PassportRepository\Http\Controllers
 *
 * @Author  Maple Grove  <bolelin@126.com> 2019/5/10 11:44
 */
class LoginController extends BaseController
{
    /**
     * @var LoginServices
     */
    private $loginServices;

    /**
     * LoginController constructor. 2020/1/29 19:47.
     *
     * @param  LoginServices  $loginServices
     *
     * @return void
     */
    public function __construct(LoginServices $loginServices)
    {
        $this->loginServices = $loginServices;
    }

    /**
     * login. 2020/1/29 19:47.
     *
     * @param  LoginRequest  $request
     *
     * @return JsonResponse|null
     */
    public function login(LoginRequest $request)
    {
        return $this->loginServices->login($request);
    }
}
