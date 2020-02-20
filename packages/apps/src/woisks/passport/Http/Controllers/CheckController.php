<?php
declare(strict_types=1);

namespace Woisks\Passport\Http\Controllers;


use Woisks\Passport\Models\Services\CheckServices;


/**
 * Class CheckController.
 *
 * @package Woisks\Passport\Http\Controllers
 *
 * @Author Maple Forest  <Woisks@126.com> 2020/1/29 12:32
 */
class CheckController extends BaseController
{
    /**
     * @var CheckServices
     */
    private $checkServices;

    /**
     * CheckController constructor. 2020/1/29 12:32.
     *
     * @param  CheckServices  $checkServices
     *
     * @return void
     */
    public function __construct(CheckServices $checkServices)
    {
        $this->checkServices = $checkServices;
    }

    /**
     * check. 2020/1/29 12:32.
     *
     * @param $type
     * @param $username
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function check($type, $username)
    {
        switch ($type) {
            case 'register':
                $res = $this->checkServices->register($username);
                break;
            case 'login':
                $res = $this->checkServices->login($username);
                break;
            case 'passport':
                $res = $this->checkServices->passport($username);
                break;
            default:
                $res = res('passport_check_param_error', '账号检查参数错误');
        }

        return $res;
    }

}
