<?php
declare(strict_types=1);


namespace Woisks\Captcha\Http\Middleware;


use Closure;
use Woisks\Captcha\Models\Traits\AuthValidateCode;

/**
 * Class ValidateCode
 *
 * @package Woisks\Captcha\Http\Middleware
 *
 * @Author  Maple Grove  <bolelin@126.com> 2019/5/16 11:23
 */
class ValidateCode
{
    use AuthValidateCode;


    /**
     * handle 2019/6/5 19:42
     *
     * @param          $request
     * @param \Closure $next
     *
     * @return \Illuminate\Http\JsonResponse|mixed
     */
    public function handle($request, Closure $next)
    {
        $name = $this->validate($request);

        if (!is_string($name)) {
            return $name;
        }

        $service = $this->service($request->input($name), $request->input('code'), $name);

        if (!is_null($service)) {
            return $service;
        }

        return $next($request);
    }

    /**
     * validate 2019/6/5 18:26
     *
     * @param $request
     *
     * @return \Illuminate\Http\JsonResponse|string
     */
    private function validate($request)
    {
        $validator = \Validator::make($request->all(), [

            'username' => 'required|string',
            'code'     => 'required|numeric|digits:6',
        ]);

        if ($validator->fails()) {
            return res('captcha_validator', $validator->errors()->first());
        }

        return 'username';
    }


    /**
     * service 2019/6/5 19:47
     *
     * @param $name
     * @param $code
     *
     * @return null|\Illuminate\Http\JsonResponse
     */
    private function service($name, $code, $name_type)
    {
        if (!is_email($name) && !is_phone($name)) {

            return res('captcha_username_error', '账号必须为合法的电子邮箱地址或手机号码 ');
        }

        $Code = $this->authCode($name, $code, $name_type);

        if (!is_null($Code)) {
            return $Code;
        }

        return null;
    }
}
