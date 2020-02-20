<?php
declare(strict_types=1);


namespace Woisks\Captcha\Models\Traits;


use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Woisks\Captcha\Models\Repository\CaptchaRepository;

/**
 * Trait AuthValidateCode
 *
 * @package Woisks\Captcha\Models\Traits
 *
 * @Author  Maple Grove  <bolelin@126.com> 2019/5/17 11:53
 */
trait AuthValidateCode
{

    public function authCode(string $name, string $code): ?JsonResponse
    {
        $db = app(CaptchaRepository::class)->nameCodeFirst($name, $code);

        //$db=null or expire_time=false
        if (!$db) {
            return res('captcha_username_or_code_error', '账号或验证码不正确');
        }
        if (Carbon::now()->timestamp > $db->expire_time) {
            return res('captcha_code_expire', '验证码已过期');
        }

        //更改状态
        $db->status = 1;
        $db->save();

        return null;
    }
}
