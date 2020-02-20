<?php
declare(strict_types=1);

namespace Woisks\Passport\Http\Requests;

/**
 * Class RegisterRequest
 *
 * @package Woisks\PassportRepository\Http\Requests
 *
 * @Author  Maple Grove  <bolelin@126.com> 2019/5/10 11:45
 */
class RegisterRequest extends Requests
{


    /**
     * rules 2019/5/10 11:45
     *
     *
     * @return array|mixed
     */
    public function rules()
    {
        return [
            'name'     => 'required|string|min:1|max:15',
            'gender'   => 'required|string',
            'birthday' => 'required|date',
            'username' => 'required|string|min:5|max:40',
            'password' => 'required|string|min:6|max:18'
        ];
    }
}
