<?php
declare(strict_types=1);

namespace Woisks\Jwt\Middleware;


use Closure;
use Woisks\Jwt\Services\JwtService;

/**
 * Class Token
 *
 * @package Woisks\Jwt\Middleware
 *
 * @Author  Maple Grove  <bolelin@126.com> 2019/5/17 20:38
 */
class Token
{
    /**
     * handle 2019/5/17 20:38
     *
     * @param          $request
     * @param  \Closure  $next
     *
     * @return \Illuminate\Http\JsonResponse|mixed
     */
    public function handle($request, Closure $next)
    {
        $token = JwtService::jwt_parser_token();
        if (!$token) {
            return res('token_require', '没有权限,请先登录');
        }

        $payload = JwtService::jwt_token_info();
        if (!is_array($payload)) {
            return res('token_invalid', '令牌无效,请重新登录');
        }

        $iva = \Redis::get('token:'.$payload['ide'].':'.$payload['mac']);

        return $iva == $payload['iva'] ? $next($request) : res('token_expire', '令牌过期,请重新登录');
    }


}
