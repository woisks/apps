<?php
declare(strict_types=1);

namespace Woisks\Passport\Models\Repository;


use Woisks\Passport\Models\Entity\TypeCountEntity;


/**
 * Class TypeRepository
 *
 * @package Woisks\PassportEntity\Models\Repository
 *
 * @Author  Maple Grove  <bolelin@126.com> 2019/5/21 19:02
 */
class TypeCountRepository
{


    /**
     * model  2019/5/21 19:02
     *
     * @var static \Woisks\PassportEntity\Models\Entity\TypeCountEntity
     */
    private static $model;


    /**
     * TypeRepository constructor. 2019/5/14 10:28
     *
     * @param  \Woisks\Passport\Models\Entity\TypeCountEntity  $typeCount
     *
     * @return void
     */
    public function __construct(TypeCountEntity $typeCount)
    {
        self::$model = $typeCount;
    }


    /**
     * typeIncrement 2019/5/21 20:15
     * 账号总数递增
     *
     * @param  string  $account_type
     *
     * @return int|bool
     */
    public function typeIncrement(string $account_type): int
    {
        return self::$model->where('type', $account_type)->increment('count');
    }


    /**
     * typeDecrement 2019/5/21 20:15
     * 账号总数递减
     *
     * @param  string  $account_type
     *
     * @return int|bool
     */
    public function typeDecrement(string $account_type): int
    {
        return self::$model->where('type', $account_type)->decrement('count');
    }

    /**
     * passport_user_add. 2019/11/23 19:00.
     * 总用户数统计
     *
     * @return mixed
     */
    public function passport_user_add()
    {
        return self::$model->where('type', 'passport')->increment('count');
    }
}
