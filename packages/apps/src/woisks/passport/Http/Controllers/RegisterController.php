<?php
declare(strict_types=1);

namespace Woisks\Passport\Http\Controllers;

use Woisks\Passport\Http\Requests\RegisterRequest;
use Woisks\Passport\Models\Services\RegisterServices;
use Woisks\Passport\Models\Services\TypeCountServices;

/**
 * Class RegisterController.
 *
 * @package Woisks\Passport\Http\Controllers
 *
 * @Author Maple Forest  <Woisks@126.com> 2020/1/29 13:00
 */
class RegisterController extends BaseController
{
    /**
     * @var RegisterServices
     */
    private $registerServices;

    /**
     * RegisterController constructor. 2020/1/29 13:00.
     *
     * @param  RegisterServices  $registerServices
     *
     * @return void
     */
    public function __construct(RegisterServices $registerServices)
    {
        $this->registerServices = $registerServices;
    }


    /**
     * register. 2020/2/2 16:00.
     *
     * @param  RegisterRequest  $request
     *
     * @return \Illuminate\Http\JsonResponse|mixed
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function register(RegisterRequest $request)
    {

        $username = $request->input('username');

        if (!is_email($username) && !is_phone($username)) {

            return res('passport_register_username_error', '账号必须为合法的电子邮箱地址或手机号码');
        }
        TypeCountServices::user_add();

        return $this->registerServices->services($request, $username);
    }


}
